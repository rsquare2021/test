<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    public function addresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }
}
