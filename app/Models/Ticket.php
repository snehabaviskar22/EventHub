<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_id',
        'ticket_quantity',
        'phone',
        'academic_program',
        'payment_status',
        'booking_date',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
