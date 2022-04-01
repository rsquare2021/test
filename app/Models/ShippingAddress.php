<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    public function getAddress(): string
    {
        return $this->prefectures.$this->municipalities.$this->address_code.$this->building;
    }

    public function getName(): string
    {
        $company_name = $this->company_name ? $this->company_name." " : "";
        return $company_name . $this->personal_name . "（" . $this->personal_name_kana . "）";
    }

    public function apply()
    {
        return $this->hasOne(Apply::class);
    }

    public function deliveryTime()
    {
        return $this->belongsTo(DeliveryTime::class);
    }

    protected $guarded = [
        "id", "created_at", "updated_at",
    ];
}
