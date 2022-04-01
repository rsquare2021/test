<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersPrePoint extends Model
{
    Public function UsersPrePoint()
    {
        return $this->belongsTo(Receipt::class, "receipt_id");
    }
}