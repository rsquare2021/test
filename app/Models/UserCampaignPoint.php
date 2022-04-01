<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserCampaignPoint extends Model
{
    public static function getLoggedInUserPoint($campaign_id): UserCampaignPoint
    {
        return self::loggedInCampaign($campaign_id)->firstOrFail();
    }

    public function scopeLoggedInCampaign($query, $campaign_id)
    {
        return $query->where("user_id", Auth::guard("user")->id())
            ->where("campaign_id", $campaign_id)
            ->select("user_campaign_points.*");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        "user_id", "campaign_id", "remaining_point", "total_point",
    ];
}
