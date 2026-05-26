<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'service',
        'service_id',
        'price',
        'currency',
        'payment_method',
        'appointment_date',
        'appointment_time',
        'end_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getTitleAttribute(): string
    {
        return ucfirst($this->service ?? $this->attributes['service'] ?? '') . ' Therapy Session';
    }

    public function getFormattedTimeRangeAttribute(): string
    {
        $start = date('h:i A', strtotime($this->appointment_time));
        $end = $this->end_time ? date('h:i A', strtotime($this->end_time)) : $start;
        return $start . ' - ' . $end;
    }
}
