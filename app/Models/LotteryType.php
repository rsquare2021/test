<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryType extends Model
{
    public const INSTANT = 1;
    public const BULK = 2;
}
