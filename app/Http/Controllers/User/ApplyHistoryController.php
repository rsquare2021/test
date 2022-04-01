<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\CancelApply;
use App\Mail\UpdateShippingAddress;
use App\Models\Apply;
use App\Models\ApplyStatus;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ApplyHistoryController extends Controller
{
    public function index($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $campaign = Campaign::findOrFail($campaign_id);
        $now = date("Ymd");
        $applies = Apply::with(["status", "campaign_product", "product"])->loggedInCampaign($campaign_id)->orderBy('id', 'desc')->get();
        return view("user.exchange.list", [
            'category_name' => 'exchange',
            'page_name' => 'exchange_list',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '交換履歴一覧',
            "campaign_id" => $campaign_id,
            "applies" => $applies,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
            "now" => $now,
        ]);
    }

    public function editAddress($campaign_id, $exchange_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $campaign = Campaign::findOrFail($campaign_id);
        $apply = Apply::loggedInCampaign($campaign_id)->canEditAddress()->findOrFail($exchange_id);
        $address = $apply->shipping_address()->withDefault()->getResults();
        $deliveries = DeliveryTime::get();
        return view("user.exchange.edit", [
            'category_name' => 'exchange',
            'page_name' => 'exchange_edit',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '交換履歴編集',
            "campaign_id" => $campaign_id,
            "apply" => $apply,
            "address" => $address,
            "campaign" => $campaign,
            "deliveries" => $deliveries,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function updateAddress(Request $request, $campaign_id, $exchange_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $campaign = Campaign::findOrFail($campaign_id);
        $safe_data = $request->validate([
            "company_name" => ["nullable", "string"],
            "personal_name" => ["required", "string"],
            "personal_name_kana" => ["required", "regex:/^[ァ-ヶー][ァ-ヶー 　]+$/u"],
            "post_code" => ["required", "regex:/^\d{3}[-]\d{4}$/"],
            "prefectures" => ["required", "string"],
            "municipalities" => ["required", "string"],
            "address_code" => ["required", "string"],
            "building" => ["nullable", "string"],
            "tel" => ["required", "regex:/^\d[\d-]*\d$/"],
            "delivery_time_id" => ["required", "integer"],
            "campaign" => $campaign,
        ]);

        $apply = Apply::loggedInCampaign($campaign_id)->canEditAddress()->findOrFail($exchange_id);
        DB::transaction(function() use($safe_data, $apply) {
            $address = $apply->shipping_address()->withDefault()->getResults();
            $address->fill($safe_data);
            $address->save();
            $apply->shipping_address()->associate($address);
            $apply->save();
        });

        Mail::send(new UpdateShippingAddress($request->user(), $campaign, $apply));

        return view("user.exchange.edit_complete", [
            'category_name' => 'exchange',
            'page_name' => 'exchange_edit_complete',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '交換履歴編集完了',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function confirmToCancelApply($campaign_id, $exchange_id)
    {
        $user = Auth::guard("user")->user();
        $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
        $campaign = Campaign::findOrFail($campaign_id);
        $apply = Apply::loggedInCampaign($campaign_id)->canCancel()->findOrFail($exchange_id);
        return view("user.exchange.cancel_confirm", [
            'category_name' => 'exchange',
            'page_name' => 'exchange_cancel_confirm',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '交換履歴キャンセル確認',
            "campaign_id" => $campaign_id,
            "apply" => $apply,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }

    public function cancelApply(Request $request, $campaign_id, $exchange_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        // 応募ロジックとして切り出すべき。
        $apply = Apply::loggedInCampaign($campaign_id)->canCancel()->findOrFail($exchange_id);
        $point = UserCampaignPoint::loggedInCampaign($campaign_id)->first();

        DB::transaction(function() use($apply, $point) {
            $point->remaining_point += $apply->getTotalPoint();
            $point->save();
            $apply->changeStatus(ApplyStatus::CANCEL);
        });

        Mail::send(new CancelApply($request->user(), $campaign, $apply));

        return view("user.exchange.cancel_complete", [
            'category_name' => 'exchange',
            'page_name' => 'exchange_cancel_complete',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'title' => '交換履歴キャンセル完了',
            "campaign_id" => $campaign_id,
            "campaign" => $campaign,
            "point" => $point,
            "user" => $user,
        ]);
    }
}
