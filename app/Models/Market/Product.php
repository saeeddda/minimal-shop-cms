<?php

namespace App\Models\Market;

use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rateable;

class Product extends Model
{
    use SoftDeletes, Sluggable, Rateable;

    protected $fillable = [
        'name',
        'introduction',
        'slug',
        'image',
        'weight',
        'height',
        'width',
        'length',
        'price',
        'status',
        'marketable',
        'tags',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'brand_id',
        'category_id',
        'published_at',
    ];

    protected $casts = [
        'image' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function meta(){
        return $this->hasMany(ProductMeta::class);
    }

    public function colors(){
        return $this->hasMany(ProductColor::class);
    }

    public function guarantees(){
        return $this->hasMany(Guarantee::class);
    }

    public function galleries(){
        return $this->hasMany(ProductGallery::class);
    }

    public function categoryValues(){
        return $this->hasMany(CategoryValue::class);
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function amazingCoupons(){
        return $this->hasMany(AmazingCoupon::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function compares(){
        return $this->belongsToMany(Compare::class);
    }

    public function getActiveAmazingCoupon(){
        return $this->amazingCoupons()
            ->where('status',1)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();
    }

    public function activeComments(){
        return $this->comments()->where([
            'approved' => 1,
            'status' => 1,
            'parent_id' => null
        ])->get();
    }

    public function getGetSalePriceFormatedAttribute(){
        if(!empty($this->getActiveAmazingCoupon())){
            $finalPrice = priceFormat($this->price - (($this->getActiveAmazingCoupon()->percentage / 100) * $this->price));
        }else{
            $finalPrice = priceFormat($this->price);
        }
        return $finalPrice;
    }

    public function getGetDiscountPriceFormatedAttribute(){
        return priceFormat(($this->getActiveAmazingCoupon()->percentage / 100) * $this->price);
    }

    public function getGetSalePriceAttribute(){
        if(!empty($this->getActiveAmazingCoupon())){
            $finalPrice = $this->price - (($this->getActiveAmazingCoupon()->percentage / 100) * $this->price);
        }else{
            $finalPrice = $this->price;
        }
        return $finalPrice;
    }

    public function getGetDiscountPriceAttribute(){
        if($this->getActiveAmazingCoupon() != null){
            return ($this->getActiveAmazingCoupon()->percentage / 100) * $this->price;
        }

        return false;
    }

    public function getGetPriceFormatedAttribute(){
        return priceFormat($this->price);
    }
}
