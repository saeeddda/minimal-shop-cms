<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'city_id',
        'postalcode',
        'address',
        'number',
        'unit',
        'recipient_first_name',
        'recipinet_last_name',
        'mobile',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function getGetRecipientFullNameAttribute(){
        return "$this->recipient_first_name $this->recipinet_last_name";
    }
}
