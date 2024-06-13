<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'url',
        'position',
        'status'
    ];

    protected $casts = [
        'image' => 'array'
    ];

    protected static $positions = [
        0 => 'اسلایدر اصلی',
        1 => 'بنر کنار اسلایدر اصلی',
        2 => 'بنر وسط صفحه اصلی',
        3 => 'بنر پایین صفحه اصلی',
    ];

    public function getGetPositionTextAttribute(): string
    {
        return self::$positions[$this->position];
    }
}
