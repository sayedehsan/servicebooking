<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'status', // pending, confirmed, cancelled, completed
        'payment_status', // unpaid, paid, refunded
        'amount',
        'currency',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
