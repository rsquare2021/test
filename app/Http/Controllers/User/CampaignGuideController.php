<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\UserCampaignPoint;
use App\Models\UsersPrePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignGuideController extends Controller
{
    public function faq($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.faq", [
                'category_name' => 'guide',
                'page_name' => 'guide_faq',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'よくある質問',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.faq", [
                'category_name' => 'guide',
                'page_name' => 'guide_faq',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'よくある質問',
                "campaign" => $campaign,
            ]);
        }
    }
    public function terms($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.terms", [
                'category_name' => 'guide',
                'page_name' => 'guide_terms',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '当サイトのご利用にあたって',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.terms", [
                'category_name' => 'guide',
                'page_name' => 'guide_terms',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '当サイトのご利用にあたって',
                "campaign" => $campaign,
            ]);
        }
    }
    public function privacypolicy($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.privacypolicy", [
                'category_name' => 'guide',
                'page_name' => 'guide_privacypolicy',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'プライバシーポリシー',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.privacypolicy", [
                'category_name' => 'guide',
                'page_name' => 'guide_privacypolicy',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'プライバシーポリシー',
                "campaign" => $campaign,
            ]);
        }
    }

    public function gifteebox($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.gift.point.gifteebox_intro", [
                'category_name' => 'guide',
                'page_name' => 'gifteebox_intro',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'giftee Box 商品ラインナップ',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.gift.point.gifteebox_intro", [
                'category_name' => 'guide',
                'page_name' => 'gifteebox_intro',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'giftee Box 商品ラインナップ',
                "campaign" => $campaign,
            ]);
        }
    }

    public function selectablepay($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.gift.point.selectablepay_intro", [
                'category_name' => 'guide',
                'page_name' => 'selectablepay_intro',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'えらべるPay 商品ラインナップ',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.gift.point.selectablepay_intro", [
                'category_name' => 'guide',
                'page_name' => 'selectablepay_intro',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => 'えらべるPay 商品ラインナップ',
                "campaign" => $campaign,
            ]);
        }
    }
    public function out_term($campaign_id)
    {
        $user = Auth::guard("user")->user();
        $campaign = Campaign::findOrFail($campaign_id);
        if($user) {
            $point = UserCampaignPoint::getLoggedInUserPoint($campaign_id);
            return view("user.out_term", [
                'category_name' => 'guide',
                'page_name' => 'out_term',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '期間外のアクセス',
                "campaign" => $campaign,
                "point" => $point,
                "user" => $user,
            ]);
        } else {
            return view("user.out_term", [
                'category_name' => 'guide',
                'page_name' => 'out_term',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',
                'title' => '期間外のアクセス',
                "campaign" => $campaign,
            ]);
        }
    }
}
