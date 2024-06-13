<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject',
        'description',
        'reference_id',
        'user_id',
        'category_id',
        'priority_id',
        'seen',
        'status',
        'ticket_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function priority(){
        return $this->belongsTo(TicketPriority::class);
    }

    public function category(){
        return $this->belongsTo(TicketCategory::class);
    }
}
