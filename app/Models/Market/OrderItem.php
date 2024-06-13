<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function amazingCoupon(){
        return $this->belongsTo(AmazingCoupon::class);
    }

    public function color(){
        return $this->belongsTo(ProductColor::class);
    }

    public function guarantee(){
        return $this->belongsTo(Guarantee::class);
    }

    public function orderItemAttribute(){
        return $this->hasMany(OrderItemSelectedAttribute::class);
    }

    public function getItemDescriptionAttribute(){
        $color = $this->color->color_name ?? 'بدون رنگ';
        $guarantee = $this->guarantee->name ?? 'بدون گارانتی';
        return "رنگ : {$color} - گارانتی : {$guarantee}";
    }
}
