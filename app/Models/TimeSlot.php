<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = [
        'label',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'day_of_week' => 'integer',
    ];

    public function getStartFormattedAttribute(): string
    {
        return date('h:i A', strtotime($this->start_time));
    }

    public function getEndFormattedAttribute(): string
    {
        return date('h:i A', strtotime($this->end_time));
    }

    public function getDayLabelAttribute(): string
    {
        if ($this->day_of_week === null) {
            return 'All Days';
        }
        return ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'][$this->day_of_week] ?? 'Unknown';
    }
}
