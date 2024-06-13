<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'percentage',
        'discount_selling',
        'minimum_order_amount',
        'status',
        'start_date',
        'end_date',
    ];
}
