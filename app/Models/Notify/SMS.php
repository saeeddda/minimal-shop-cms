<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMS extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public_sms';

    protected $fillable = [
        'title',
        'status',
        'body',
        'published_at'
    ];
}
