<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'percentage',
        'status',
        'start_date',
        'end_date',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
