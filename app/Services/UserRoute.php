<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\User;
use App\Models\UserCampaignPoint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoute
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function user(): ?User
    {
        return Auth::guard("user")->user();
    }

    public function point(): ?UserCampaignPoint
    {
        return UserCampaignPoint::loggedInCampaign($this->getCampaignId())->first();
    }

    public function campaign(): Campaign
    {
        $campaign_id = $this->getCampaignId();
        if($campaign_id == $this->found_campaign_id) return $this->campaign;

        if(!$this->request->routeIs("campaign.*")) throw new Exception("エンドユーザー機能ではないルーティングから呼び出されました。");

        // エンドユーザー機能からキャンペーンデータを変更しないと思うので、一度読み込んだら保持しておく。
        // もしキャンペーンデータが変更されるような場合、このファサードは古いデータを返し続けるので注意。
        $this->campaign = Campaign::findOrFail($campaign_id);
        $this->found_campaign_id = $campaign_id;
        return $this->campaign;
    }

    protected function getCampaignId()
    {
        return $this->request->route("campaign_id");
    }

    protected $request;
    protected $campaign = null;
    protected $found_campaign_id = null;
}