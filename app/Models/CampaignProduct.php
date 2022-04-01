<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignProduct extends Model
{
    public function is_instant_lottery() { return $this->lottery_type_id == LotteryType::INSTANT ? true : false; }
    public function is_bulk_lottery()    { return $this->lottery_type_id == LotteryType::BULK ? true : false; }

    public function is_catalog_product()        { return $this->getProductType() == self::TYPE_CATALOG_PRODUCT ? true : false; }
    public function is_lottery_course()         { return $this->getProductType() == self::TYPE_LOTTERY_COURSE ? true : false; }
    public function is_lottery_course_product() { return $this->getProductType() == self::TYPE_LOTTERY_COURSE_PRODUCT ? true : false; }

    public function getGifteeBoxPrice($quantity): int
    {
        // return $this->point * $quantity * 5;
        return $quantity * 100;
    }

    public function getProductName()
    {
        if($this->is_lottery_course()) {
            return $this->name;
        }
        else {
            return $this->product->name;
        }
    }

    public function getPoint()
    {
        return $this->point;
    }

    // カテゴリー名
    public function getCategoryName()
    {
        if($this->is_catalog_product()) {
            return $this->product->product_category->name;
        }
    }

    public function can_apply($campaign_id)
    {
        // ブラックリスト形式でチェックしていく。

        // 景品タイプチェック
        if($this->is_catalog_product()) {
            // 当選本数が0の場合は return false; にする。
        }
        elseif($this->is_lottery_course()) {
            // すべてのコース景品の当選本数が0の場合は return false; にする。
        }
        else {
            return false;
        }

        // キャンペーンIDチェック
        if($this->campaign_id != $campaign_id) return false;

        return true;
    }

    public function scopeWhereCampaign($query, $campaign_id)
    {
        return $query->join("flat_campaign_products", "campaign_products.id", "=", "flat_campaign_products.id")
            ->where("flat_campaign_products.campaign_id", $campaign_id);
    }

    public function scopeCanApply($query)
    {
        return $query->where("course_id", null);
    }

    // 抽選型で使うかも？
    // public function through_campaign()
    // {
    //     if($this->course_id) {
    //         return $this->belongsTo(self::class, "course_id")->getResults()->belongsTo(Campaign::class);
    //     }
    //     else {
    //         return $this->belongsTo(Campaign::class);
    //     }
    // }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, "course_id");
    }

    public function products()
    {
        return $this->hasMany(self::class, "course_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function applies()
    {
        return $this->hasMany(Apply::class);
    }

    protected $fillable = [
        "name", "point", "win_rate", "win_limit",
        "product_id", "campaign_id", "gift_delivery_method_id",
    ];

    private function getProductType()
    {
        if($this->campaign) {
            return $this->product_id ? self::TYPE_CATALOG_PRODUCT : self::TYPE_LOTTERY_COURSE;
        }
        else {
            return self::TYPE_LOTTERY_COURSE_PRODUCT;
        }
    }

    private const TYPE_CATALOG_PRODUCT = 1;
    private const TYPE_LOTTERY_COURSE = 2;
    private const TYPE_LOTTERY_COURSE_PRODUCT = 3;
}
