<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopTreeElement extends Model
{
    public static function getTreeFrom($id)
    {
        $p = ShopTreeElement::with("level")->find($id);
        $lower_level_count = ShopTreeLevel::where("depth", ">", $p->level->depth)->count();
        $with_query = implode(".", array_fill(0, $lower_level_count, "children"));
        return ShopTreeElement::with($with_query)->find($id);
    }

    public function scopeRoot($query)
    {
        return $query->where("parent_id", null);
    }

    public function parent()
    {
        return $this->belongsTo(ShopTreeElement::class, "parent_id");
    }

    public function children()
    {
        return $this->hasMany(ShopTreeElement::class, "parent_id");
    }

    public function level()
    {
        return $this->belongsTo(ShopTreeLevel::class, "shop_tree_level_id");
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    protected $fillable = [
        "name", "shop_tree_level_id",
    ];
}
