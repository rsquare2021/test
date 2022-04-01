<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    public static function getProductCategoryList()
    {
        return self::with("children")->where("parent_id", null)->get();
    }

    public function scopeCanBecomeParent($query)
    {
        return $query->where("parent_id", null)
            ->whereNotExists(function($query){
                $query->select(DB::raw(1))
                    ->from("products")
                    ->whereRaw("products.product_category_id = product_categories.id");
            });
    }

    public function parent()
    {
        return $this->belongsTo(self::class, "parent_id")->withDefault();
    }

    public function children()
    {
        return $this->hasMany(self::class, "parent_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        "name", "parent_id",
    ];
}
