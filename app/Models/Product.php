<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function isGifteeBox()
    {
        return $this->is_giftee_box ? true : false;
    }

    public function hasVariation()
    {
        return !$this->variations->isEmpty();
    }

    public function scopeIsVariation($query)
    {
        return $query->where("variation_parent_id", "<>", null);
    }

    public function scopeIsNotVariation($query)
    {
        return $query->where("variation_parent_id", null);
    }

    public function campaign_products()
    {
        return $this->hasMany(CampaignProduct::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withDefault();
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class)->withDefault();
    }

    public function variations()
    {
        return $this->hasMany(self::class, "variation_parent_id");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected $guarded = [
        "id", "created_at", "updated_at",
    ];
}
