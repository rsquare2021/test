<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\ApplyStatus;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function index(Request $request, $campaign)
    {
        // 検索用変数セット
        $apply_id = '';
        $apply_user_id = '';
        $apply_user_company = '';
        $apply_user_name = '';
        $operation_id = '';
        $start_date = '';
        $end_date = '';
        // 応募一覧ベース
        $applies = Apply::join("users", "users.id", "=", "applies.user_id")->with(["product", "status", "shipping_address"])
            ->join("campaign_products", function($join) use($campaign) {
                $join->on("campaign_products.id" ,"=", "applies.campaign_product_id")
                    ->where("campaign_products.campaign_id", $campaign);
            });
        // 交換ID
        $apply_id = $request->input('apply_id');
        if($apply_id) {
            $applies->where('applies.id', $apply_id);
        }
        // 応募者ID
        $apply_user_id = $request->input('apply_user_id');
        if($apply_user_id) {
            $applies->where('applies.user_id', $apply_user_id);
        }
        // 会社名 *あいまい検索
        $apply_user_company = $request->input('apply_user_company');
        if($apply_user_company) {
            $applies = $applies->whereHas('shipping_address', function($applies) use ($apply_user_company) {
                $applies->where('company_name', 'like', "%$apply_user_company%");
            });
        }
        // 名前 *あいまい検索
        $apply_user_name = $request->input('apply_user_name');
        if($apply_user_name) {
            $applies = $applies->whereHas('shipping_address', function($applies) use ($apply_user_name) {
                $applies->where('personal_name', 'like', "%$apply_user_name%");
            });
        }
        // 景品管理番号
        $operation_id = $request->input('operation_id');
        if($operation_id) {
            $applies = $applies->whereHas('product', function($applies) use ($operation_id) {
                $applies->where('operation_id', $operation_id);
            });
        }
        // 申し込み日
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $base_start_date = $start_date;
        $base_end_date = $end_date;
        if($start_date && $end_date) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
        } elseif($start_date) {
            $start_date = $request->input('start_date');
            $date = new Carbon($end_date);
            $end_date = $date->addDay();
            $end_date = '2030-10-10';
        } elseif($end_date) {
            $start_date = '2010-10-10';
            $end_date = $request->input('end_date');
            $date = new Carbon($end_date);
            $end_date = $date->addDay();
        }
        if($start_date || $end_date) {
            $applies->whereBetween('applies.created_at', [$start_date, $end_date]);
        }
        // ステータス
        $apply_status = $request->input('apply_status');
        if($apply_status == 'apply_status_13') {
            $applies->where('applies.apply_status_id', 13);
        } elseif($apply_status == 'apply_status_33') {
            $applies->where('applies.apply_status_id', 33);
        } elseif($apply_status == 'apply_status_31') {
            $applies->where('applies.apply_status_id', 31);
        }
        // 検索
        $applies = $applies->select("applies.*","users.email")->paginate(20);
        return view("admin.project.apply.list", [
            'category_name' => 'project',
            'page_name' => 'project_apply',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '応募一覧',
            'applies' => $applies,
            "apply_id" => $apply_id,
            "apply_user_id" => $apply_user_id,
            "apply_user_company" => $apply_user_company,
            "apply_user_name" => $apply_user_name,
            "operation_id" => $operation_id,
            "start_date" => $base_start_date,
            "end_date" => $base_end_date,
            "apply_status" =>$apply_status,
            "campaign" =>$campaign,
        ]);
    }

    public function changeStatus(Request $request, $campaign_id)
    {
        $apply = Apply::findOrFail($request->apply_id);
        // 応募とキャンペーンがリンクしてるか確認。
        if($apply->campaign_product->campaign_id != $campaign_id) {
            throw new Exception("キャンペーンと応募がリンクしていません。");
        }

        // ステータスIDが変更可能かどうか確認。
        if(
            !(ApplyStatus::canEditAdminApply($apply->apply_status_id) &&
            ApplyStatus::canEditAdminApply($request->new_status_id))
        ) {
            throw new Exception("このステータスは変更できません。");
        }

        // 応募ステータスを変更
        // 発送管理の操作性のために自由に変更できるようにする。よってchangeStatusメソッドは使わない。
        $apply->update([
            "apply_status_id" => $request->new_status_id,
        ]);

        return $apply->status->name;
    }
}
