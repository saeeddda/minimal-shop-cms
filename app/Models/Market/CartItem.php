<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'guarantee_id',
        'number',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function guarantee(){
        return $this->belongsTo(Guarantee::class);
    }

    public function color(){
        return $this->belongsTo(ProductColor::class);
    }

    public function cartItemPrice(){
        $guaranteePrice = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPrice = empty($this->color_id) ? 0 : $this->color->price_increase;
        return $this->product->price + $guaranteePrice + $colorPrice;
    }

    public function cartItemDiscountPrice(){
        return $this->product->getDiscountPrice;
    }

    public function cartItemTotalPrice(){
        return $this->number * $this->cartItemPrice();
    }

    public function cartItemFinalPrice(){
        return $this->number * ($this->cartItemPrice() - $this->cartItemDiscountPrice());
    }

    public function cartItemTotalDiscount(){
        return  $this->number * $this->cartItemDiscountPrice();
    }
}
