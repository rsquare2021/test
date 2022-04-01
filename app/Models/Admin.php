<?php

namespace App\Models;

use App\Notifications\Admin\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Auditable;

class Admin extends Authenticatable implements Auditable
{
    use Notifiable, \OwenIt\Auditing\Auditable, SoftDeletes;

    public function filterShopTreeElementId($ids): Collection
    {
        // 所属会社と紐づく店舗ツリー以外のツリー要素を除外する。
        $related_root_ids = $this->company->getShopTreeRoots()->pluck("id");
        return FlatShopTreeElement::
            whereIn("id", $ids)
            ->whereIn("root_id", $related_root_ids)
            ->pluck("id")
            ;
    }

    public function isSuperAdmin()   { return $this->admin_role_id == AdminRole::SUPER_ADMIN; }
    public function isRegularAdmin() { return $this->admin_role_id == AdminRole::REGULAR_ADMIN; }

    public function scopeExcludeSuperAdminById($query, $admin_id)
    {
        return $query->where("admin_role_id", AdminRole::SUPER_ADMIN)->where("id", "<>", $admin_id);
    }

    public function admin_role()
    {
        return $this->belongsTo(AdminRole::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function shop_tree_elements()
    {
        return $this->belongsToMany(ShopTreeElement::class)->withTimestamps();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    protected $fillable = [
        "name", "email", "password", "office_name",
        "admin_role_id",
    ];

    protected $hidden = [
        "password", "remember_token",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}
