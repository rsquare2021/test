<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPreset extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    protected $fillable = [
        "name",
    ];
}
