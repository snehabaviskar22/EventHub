<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'venue',
        'price',
        'available_seats',
        'booking_deadline',
        'eligible_programs',
        'open_to_all',
        'banner',
        'audio',
        'video',
        'is_published',
    ];

    protected function casts(): array
{
    return [
        'event_date' => 'date',
        'booking_deadline' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'price' => 'decimal:2',
        'open_to_all' => 'boolean',
        'is_published' => 'boolean',
    ];
}

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /** Scope to only published events. */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /** Get eligible programs as an array. */
    public function getEligibleProgramsArray(): array
    {
        if ($this->open_to_all || empty($this->eligible_programs)) {
            return [];
        }

        return array_map('trim', explode(',', $this->eligible_programs));
    }

    /** Check if a student's academic program is eligible. */
    public function isProgramEligible(?string $program): bool
    {
        if ($this->open_to_all) {
            return true;
        }

        $eligible = $this->getEligibleProgramsArray();

        return in_array($program, $eligible);
    }

    /** Check if booking deadline has passed. */
    public function isBookingOpen(): bool
    {
        return $this->booking_deadline->isFuture() || $this->booking_deadline->isToday();
    }

    /** Check if seats are available for the requested quantity. */
    public function hasSeatsAvailable(int $quantity = 1): bool
    {
        return $this->available_seats >= $quantity;
    }

    /** Check if this event overlaps in time with another event's date/time range. */
    public function overlapsWith(self $other): bool
    {
        if (!$this->event_date->isSameDay($other->event_date)) {
            return false;
        }

        return $this->start_time < $other->end_time && $other->start_time < $this->end_time;
    }
}
