<?php

namespace App\Models;

use App\Facades\UserRoute;
use App\Notifications\User\ResetPassword;
use App\Notifications\User\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * @return int 加算された合計プレポイント。
     */
    public function combinePrePoint($campaign_id): int
    {
        
        // ステータス0のポイント候補レシート取得
        $prepoints = UsersPrePoint::with("UsersPrePoint")->join("receipts", "users_pre_points.receipt_id", "=", "receipts.id")
            ->where("receipts.user_id", $this->id)
            ->where("receipts.campaign_id", $campaign_id)
            ->whereNotIn("receipts.status", [90,94,95])
            ->where("users_pre_points.updated_at", "<", Carbon::now()->subMinutes(5720)->toDateTime())
            ->get("users_pre_points.*")
            ;
        // 目検確認後のポイント候補レシート取得
        $accept_prepoints = UsersPrePoint::select("users_pre_points.id as users_pre_points_id","users_pre_points.point as add_point","users_pre_points.*","receipts.id as receipt_id","receipts.*")->with("UsersPrePoint")->join("receipts", "users_pre_points.receipt_id", "=", "receipts.id")
            ->where("receipts.user_id", $this->id)
            ->where("receipts.campaign_id", $campaign_id)
            ->whereIn("receipts.status", [90,94,95])
            ->where("users_pre_points.updated_at", "<", Carbon::now()->subMinutes(2880)->toDateTime())
            ->get()
            ;
        if($accept_prepoints) {
            $accept_total_point = $accept_prepoints->sum("add_point");
            $accept_user_id = $accept_prepoints->pluck("user_id");
            $accept_prepoints_id = $accept_prepoints->pluck("users_pre_points_id");

            UserCampaignPoint::whereIn("user_id", $accept_user_id)
                ->whereIn("campaign_id", $accept_prepoints->pluck("campaign_id"))
                ->update([
                    "remaining_point" => DB::raw("remaining_point + $accept_total_point"),
                    "total_point" => DB::raw("total_point + $accept_total_point"),
                ]);
                
            UsersPrePoint::whereIn("id", $accept_prepoints_id)->delete();
            Receipt::whereIn("id", $accept_prepoints->pluck("receipt_id"))->update([
                "status" => "100",
            ]);
        }

        if($prepoints->isEmpty()) return 0;

        $related_campaign_shop_ids = UserRoute::campaign()->shop_tree_elements->pluck("id");
        $shop_ids = FlatShopTreeElement::getLowers($related_campaign_shop_ids)->pluck("id");

        // プレポイント元のレシートを分類（グルーピング）する
        $partitions = $prepoints->groupBy(function($v) {
            // レシートと紐づかない不整合なデータ
            $receipt = $v->UsersPrePoint;
            if(!$receipt) return "unknown";

            // レシート発行したのは特約店かどうか
            // ShopTreeElement::whereIn("id", $shop_ids)->where("tel", $receipt->tel)->get();
            $receipt_issued_shops = ShopTreeElement::where("tel", $receipt->tel)->orWhere("tel_sub", $receipt->tel)->get();
            $is_dealer_receipt = 
                $receipt_issued_shops
                ->filter(function($v) {
                    return !$v->direct;
                })
                ->isNotEmpty()
                ;

            // レシートと一致するPOSレジデータが存在するかどうか
            $ss_codes = 
                $receipt_issued_shops
                ->map(function($v) {
                    return [$v->code1, $v->code2, $v->code3, $v->code4, $v->code5];
                })
                ->flatten()
                ->filter(function($v) {
                    return $v;
                })
                ;
            $yyyymmdd = Carbon::createFromFormat("Y-m-d", $receipt->mk_date ?? $receipt->pay_date)->format("Ymd");
            $hhnn = Carbon::createFromFormat("H:i", $receipt->mk_time ?? $receipt->time)->format("Hi");
            $count = $receipt->mk_value;

            $exists_posdata = DB::connection("wing_data")->table("sales".substr($yyyymmdd, 0, 6))->select("*")
                ->whereIn("ss", $ss_codes)
                ->where("pay_date", $yyyymmdd)
                ->where("time", $hhnn)
                ->where("count", $count)
                ->get()
                ->isNotEmpty()
                ;

            // グルーピングのキー名を返す
            if($exists_posdata) {
                return "exists";
            }
            else {
                return $is_dealer_receipt ? "not_exists_dealer" : "not_exists_directly";
            }
        });

        $total_added_point = 0;
        $IDS = '';
        // グルーピングごとにDB処理
        DB::transaction(function() use($campaign_id, $partitions, &$total_added_point) {
            // unknown は放置

            // exists
            // POSレジデータに存在したものはプレポイントを現ポイントに反映し、ステータス(100)にする。
            if($exists = $partitions["exists"] ?? null) {
                $total_point = $exists->sum("point");
                UserCampaignPoint::where("user_id", $this->id)
                    ->where("campaign_id", $campaign_id)
                    ->update([
                        "remaining_point" => DB::raw("remaining_point + $total_point"),
                        "total_point" => DB::raw("total_point + $total_point"),
                    ]);
                // 今だけステータス確認用
                // UsersPrePoint::whereIn("id", $exists->pluck("id"))->update([
                //     "check_status" => 0,
                // ]);
                // 今だけコメントアウト
                UsersPrePoint::whereIn("id", $exists->pluck("id"))->delete();
                Receipt::whereIn("id", $exists->pluck("receipt_id"))->update([
                    "status" => "100",
                ]);
                $total_added_point += $total_point;
                $IDS = $exists->pluck("id").',';
            }



            // not_exists_directly
            // 直営店レシートでPOSレジデータが存在しないものはレシートステータスをエラー(99)にし、プレポイントも反映しない。
            if($directly = $partitions["not_exists_directly"] ?? null) {
                // 今だけステータス確認用
                // UsersPrePoint::whereIn("id", $exists->pluck("id"))->update([
                //     "check_status" => 90,
                // ]);
                // 今だけコメントアウト
                Receipt::whereIn("id", $directly->pluck("receipt_id"))->update([
                    "status" => "15",
                    "status_nodata" => 1,
                ]);
                UsersPrePoint::whereIn("id", $directly->pluck("id"))->delete();
            }


            // not_exists_dealer
            // 特約店レシートでPOSレジデータが存在しないものは、低ポイントはそのまま付与し、高ポイントはエラー(15)にする。
            if($dealer = $partitions["not_exists_dealer"] ?? null) {
                list($over4, $under4) = $dealer->partition(function($v) {
                    return $v->point >= 5;
                });
                // 高ポイントはエラー
                // 今だけステータス確認用
                // UsersPrePoint::whereIn("id", $over4->pluck("id"))->update([
                //     "check_status" => 91,
                // ]);
                // 今だけコメントアウト
                Receipt::whereIn("id", $over4->pluck("receipt_id"))->update([
                    "status" => "15",
                    "status_nodata" => 1,
                ]);
                UsersPrePoint::whereIn("id", $over4->pluck("id"))->delete();
                // 低ポイントは付与
                $under4_totalpoint = $under4->sum("point");
                UserCampaignPoint::where("user_id", $this->id)
                    ->where("campaign_id", $campaign_id)
                    ->update([
                        "remaining_point" => DB::raw("remaining_point + $under4_totalpoint"),
                        "total_point" => DB::raw("total_point + $under4_totalpoint"),
                    ]);
                // 今だけステータス確認用
                UsersPrePoint::whereIn("id", $under4->pluck("id"))->update([
                    "check_status" => 1,
                ]);
                // 今だけコメントアウト
                UsersPrePoint::whereIn("id", $under4->pluck("id"))->delete();
                Receipt::whereIn("id", $under4->pluck("receipt_id"))->update([
                    "status" => "100",
                ]);
                $total_added_point += $under4_totalpoint;
            }
        });

        return $total_added_point;
    }

    public function hasSnsLogin(): bool
    {
        return $this->provider_user_id ? true : false;
    }

    public function isJoinedCampaign($campaign_id)
    {
        return UserCampaignPoint::loggedInCampaign($campaign_id)->first() ? true : false;
    }

    public function joinCampaign($campaign_id)
    {
        $point = new UserCampaignPoint();
        $point->user_id = Auth::guard("user")->id();
        $point->campaign_id = $campaign_id;
        $point->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        "provider", "provider_user_id",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
