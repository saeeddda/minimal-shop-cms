<?php

namespace App\Models;

use App\Models\Market\Compare;
use App\Models\Market\Coupon;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Traits\Permissions\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\CanRate;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, SoftDeletes, HasPermission, CanRate;

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'status',
        'user_type',
        'activation',
        'profile_photo_path',
        'email_verified_at',
        'mobile_verified_at',
        'phone_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute(){
        return "$this->first_name $this->last_name";
    }

    public function ticketAdmin(){
        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function coupons(){
        return $this->hasMany(Coupon::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function addresss(){
        return $this->hasMany(Address::class);
    }

    public function orderItems(){
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }

    public function compare(){
        return $this->hasOne(Compare::class);
    }
}
