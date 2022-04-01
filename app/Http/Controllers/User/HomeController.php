<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\UsersPrePoint;
use App\Models\Receipt;
use App\Models\Apply;
use App\Models\Ngword;
use App\Models\OcrList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(Request $request, $campaign_id)
    {
        // ユーザー情報・キャンペーン情報
        /** @var User */
        $user = Auth::guard("user")->user();
        $user_setmail = $user->email_verified_at;
        $campaign = Campaign::findOrFail($campaign_id);
        // $ngs = Ngword::select('name')->where('campaign_id',$campaign_id)->where('level',1)->get();
        // $light_ngs = Ngword::select('name')->where('campaign_id',$campaign_id)->where('level',2)->get();
        // $ocr_lists = OcrList::where('campaign_id',$campaign_id)->where('level',0)->first();
        // $level1_lists = OcrList::where('campaign_id',$campaign_id)->where('level',1)->get();
        // $request->session()->put('ngs', $ngs);
        // $request->session()->put('light_ngs', $light_ngs);
        // $request->session()->put('ocr_value', $ocr_lists->products);
        // $request->session()->put('level1_lists', $level1_lists);
        // プレポイント追加
        $user->combinePrePoint($campaign_id);
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        // 交換回数
        $exchange_count = Apply::join('campaign_products','applies.campaign_product_id','=','campaign_products.id')
        ->whereCampaignId($campaign_id)
        ->whereUserId($user->id)
        ->where('apply_status_id','!=','12')
        ->where('apply_status_id','!=','21')
        ->count();
        // 送信レシート数
        $stay_receipt_count = Receipt::whereCampaignId($campaign_id)->whereUserId($user->id)->where('mk_status','!=','0')->where('mk_status','!=','99')->count();
        // ニュース
        $news_list = [];
        // レシート却下数
        $reject = Receipt::whereCampaignId($campaign_id)->whereUserId($user->id)->whereIn('status',[91,92,96,97,98,99])->count();

        $end_date = $campaign->end_datetime_to_convert_receipts_to_points->format("Ymd");
        $now = date("Ymd");
        $diff = '';
        return view("user.dashboard", [
            'category_name' => 'dashboard',
            'page_name' => 'dashboard',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => 'ダッシュボード',
            "campaign" => $campaign,
            "point" => $point,
            "exchange_count" => $exchange_count,
            "stay_receipt_count" => $stay_receipt_count,
            "debug" => $stay_receipt_count,
            "campaign_id" => $campaign_id,
            "user_setmail" => $user_setmail,
            "diff" => $diff,
            "user" => $user,
            "reject" => $reject,
        ]);
    }
}
