<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'body',
        'parent_id',
        'author_id',
        'commentable_id',
        'commentable_type',
        'approved',
        'status',
    ];

    public function commentable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function parent(){
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers(){
        return $this->hasMany($this, 'parent_id');
    }
}
