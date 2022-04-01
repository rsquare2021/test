<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    public const SUPER_ADMIN = 1;
    public const REGULAR_ADMIN = 2;
    public const ROW_ADMIN = 3;
}
