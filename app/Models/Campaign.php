<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Campaign extends Model
{
    /**
     * 管理者の担当店舗と紐づいているキャンペーンをリスト化する。
     */
    public static function getRelatingCampaigns(Admin $admin): Collection
    {
        $element_ids = $admin->shop_tree_elements->pluck("id");
        $lower_elements = FlatShopTreeElement::getLowers($element_ids);
        $upper_elements = FlatShopTreeElement::getUppers($element_ids);
        $target_element_ids = $lower_elements->merge($upper_elements)->pluck("id")->toArray();
        $campaigns = Campaign::query()->whereHas("shop_tree_elements", function($query) use($target_element_ids) {
            $query->whereIn("campaign_shop_tree_element.shop_tree_element_id", $target_element_ids);
        })->withCount("applies")->get();
        return $campaigns;
    }

    public static function findFromRoute()
    {
        if(self::$campaign_by_user_routing == null) {
            self::$campaign_by_user_routing = self::findOrFail(request()->route("campaign_id"));
        }
        return self::$campaign_by_user_routing;
    }

    public function canEdit(Admin $admin)
    {
        $admin_shop_ids = $admin->shop_tree_elements->pluck("id");
        $lowers = FlatShopTreeElement::getLowers($admin_shop_ids);
        $uppers = FlatShopTreeElement::getUppers($admin_shop_ids);
        return $lowers->merge($uppers)->whereIn("id", $this->shop_tree_elements->pluck("id"))->isNotEmpty();
    }

    public function getDayCountToCloseReceipt(): int
    {
        return Carbon::today()->diffInDays($this->getCloseReceipt(), false);
    }

    public function getCloseReceipt(): DateTime
    {
        return $this->end_datetime_to_convert_receipts_to_points;
    }

    public function getCloseApply(): DateTime
    {
        if($this->is_catalog_type()) {
            return $this->close_datetime;
        }
        return $this->end_datetime_to_convert_receipts_to_points;
    }

    public function getCloseCampaign(): DateTime
    {
        return $this->close_datetime;
    }

    public function is_catalog_type() { return $this->campaign_type_id == CampaignType::CATALOG ? true : false; }
    public function is_lottery_type() { return $this->campaign_type_id == CampaignType::LOTTERY ? true : false; }

    public function scopeIsCatalogType($query) { return $query->where("campaign_type_id", CampaignType::CATALOG); }
    public function scopeIsLotteryType($query) { return $query->where("campaign_type_id", CampaignType::LOTTERY); }

    public function campaign_type()
    {
        return $this->belongsTo(CampaignType::class);
    }

    public function campaign_theme()
    {
        return $this->belongsTo(CampaignTheme::class);
    }

    public function products()
    {
        return $this->hasMany(CampaignProduct::class);
    }

    public function applies()
    {
        return $this->hasManyThrough(Apply::class, FlatCampaignProduct::class, "campaign_id", "campaign_product_id");
    }

    public function shop_tree_elements()
    {
        return $this->belongsToMany(ShopTreeElement::class)->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $guarded = [
        "id", "campaign_type_id", "company_id", "created_at", "updated_at",
    ];

    protected $casts = [
        "publish_datetime" => "datetime",
        "close_datetime" => "datetime",
        "start_datetime_to_convert_receipts_to_points" => "datetime",
        "end_datetime_to_convert_receipts_to_points" => "datetime",
    ];

    /** @var Campaign */
    protected static $campaign_by_user_routing = null;
}
