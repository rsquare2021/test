<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Apply extends Model
{
    public function changeStatus($new_status)
    {
        // 正しい遷移かどうかチェックする。
        $old = $this->apply_status_id;
        $exception = new Exception("");
        switch($new_status) {
            case ApplyStatus::APPLYING:
                throw $exception;
                break;
            case ApplyStatus::WAITING_LOTTERY:
                if($old != ApplyStatus::APPLYING) throw $exception;
                break;
            case ApplyStatus::LOST_LOTTERY:
                $is_lost_instant = $old == ApplyStatus::APPLYING ? true : false;
                $is_lost_bulk = $old == ApplyStatus::WAITING_LOTTERY ? true : false;
                if(!$is_lost_instant and !$is_lost_bulk) throw $exception;
                break;
            case ApplyStatus::WAITING_ADDRESS:
                $is_catalog = $old == ApplyStatus::APPLYING ? true : false;
                $is_winning = $old == ApplyStatus::WAITING_LOTTERY ? true : false;
                if(!$is_catalog and !$is_winning) throw $exception;
                break;
            case ApplyStatus::CANCEL:
                $is_waiting_lottery = $old == ApplyStatus::WAITING_LOTTERY ? true : false;
                $is_waiting_address = $old == ApplyStatus::WAITING_ADDRESS ? true : false;
                if(!$is_waiting_lottery and !$is_waiting_address) throw $exception;
                break;
            case ApplyStatus::SENT_PRODUCT:
                if($old != ApplyStatus::PREPARING_SEND) throw $exception;
                break;
            case ApplyStatus::DEFECTING_ADDRESS:
                // この状態が必要かどうかまだ分からない。
                throw $exception;
            case ApplyStatus::PREPARING_SEND:
                if($old != ApplyStatus::WAITING_ADDRESS) throw $exception;
            case ApplyStatus::GIFTEE_APPLIED:
                if($old != ApplyStatus::APPLYING) throw $exception;
                break;
            case ApplyStatus::GIFTEE_REQUEST_ERROR:
                if($old != ApplyStatus::APPLYING) throw $exception;
                break;
        }

        $this->update([
            "apply_status_id" => $new_status,
        ]);
    }

    public function canEditAddress()
    {
        return collect(ApplyStatus::canEditAddress)->contains($this->apply_status_id);
    }

    public function canCancel()
    {
        return collect(ApplyStatus::canCancel)->contains($this->apply_status_id);
    }

    public function getTotalPoint()
    {
        return $this->campaign_product->point * $this->quantity;
    }

    public function scopeLoggedInCampaign($query, $campaign_id)
    {
        return $query->where("user_id", Auth::guard("user")->id())
            ->join("flat_campaign_products", "applies.campaign_product_id", "=", "flat_campaign_products.id")
            ->where("flat_campaign_products.campaign_id", $campaign_id)
            ->select("applies.*");
    }

    public function scopeCanEditAddress($query)
    {
        return $query->whereIn("apply_status_id", ApplyStatus::canEditAddress);
    }

    public function scopeCanCancel($query)
    {
        return $query->whereIn("apply_status_id", ApplyStatus::canCancel);
    }

    public function status()
    {
        return $this->belongsTo(ApplyStatus::class, "apply_status_id");
    }

    public function shipping_address()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function campaign_product()
    {
        return $this->belongsTo(CampaignProduct::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        "quantity", "apply_status_id", "user_id",
        "campaign_product_id", "product_id",
    ];
}
