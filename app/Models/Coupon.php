<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'discount',
        'type',
        'discount',
        'type',
        'discount_max',
        'number_use',
        'start',
        'end',
        'forever'
    ];
}
