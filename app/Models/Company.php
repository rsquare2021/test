<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public static function getSystemOwner()
    {
        return self::where("is_administration", false)->orderBy("id")->first();
    }

    public function isAdministration() { return $this->is_administration ? true : false; }

    public function getShopTreeRoots()
    {
        if($this->isAdministration()) {
            return ShopTreeElement::root()->get();
        }
        else {
            return $this->shopTrees;
        }
    }

    public function shopTrees()
    {
        return $this->belongsToMany(ShopTreeElement::class);
    }

    protected $fillable = [
        "name",
    ];
}
