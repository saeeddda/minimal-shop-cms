<?php

namespace App\Models\Market;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'order_final_amount' => 'int',
        'order_discount_amount' => 'int',
        'order_total_products_discount_amount' => 'int'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function generalCoupon()
    {
        return $this->belongsTo(GeneralCoupon::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function getGetOrderTotalAmountAttribute()
    {
        return ($this->order_final_amount - $this->order_discount_amount) + $this->delivery->amount;
    }

    public function getGetOrderStatusAttribute()
    {
        $status = '';

        if ($this->order_status == 0)
            $status = 'جدید';
        elseif ($this->order_status == 1)
            $status = 'در انتظار';
        elseif ($this->order_status == 2)
            $status = 'رد شده';
        elseif ($this->order_status == 3)
            $status = 'تائید شده';
        elseif ($this->order_status == 4)
            $status = 'باطل شده';
        elseif ($this->order_status == 5)
            $status = 'مرجوع شده';

        return $status;
    }

    public function getGetOrderDeliveryStatusAttribute()
    {
        $status = '';

        if ($this->delivery_status == 0)
            $status = 'ارسال نشده';
        elseif ($this->delivery_status == 1)
            $status = 'درحال ارسال';
        elseif ($this->delivery_status == 2)
            $status = 'حمل شده';
        elseif ($this->delivery_status == 3)
            $status = 'تحویل شده';

        return $status;
    }

    public function getGetOrderPaymentTypeAttribute(){
        $type = '';

        if($this->payment->type == 0)
           $type = 'آنلاین';
        elseif($this->payment->type == 1)
           $type = 'آفلاین';
        else
           $type = 'درمحل';

        return $type;
    }

    public function getGetOrderPaymentStatusAttribute()
    {
        $status = '';

        if ($this->payment_status == 0)
            $status = 'پرداخت نشده';
        elseif ($this->payment_status == 1)
            $status = 'پرداخت شده';
        elseif ($this->payment_status == 2)
            $status = 'لغو شده';
        elseif ($this->payment_status == 3)
            $status = 'مسترد شده';

        return $status;
    }

    public function getUserFullAddressAttribute(){
        return "{$this->address->city->province->name}, {$this->address->city->name}, {$this->address->address} پلاک {$this->address->number} واحد {$this->address->unit}";
    }
}
