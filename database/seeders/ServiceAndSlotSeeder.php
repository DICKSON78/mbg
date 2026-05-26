<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\TimeSlot;

class ServiceAndSlotSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Individual Therapy',
            'slug' => 'individual',
            'description' => 'One-on-one sessions for adults, youth (10+), and seniors addressing anxiety, depression, trauma, and life transitions.',
            'price' => 80.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        Service::create([
            'name' => 'Couples Counseling',
            'slug' => 'couples',
            'description' => 'Strengthen your relationship through conflict resolution, communication skills, and intimacy building.',
            'price' => 100.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        Service::create([
            'name' => 'Family Therapy',
            'slug' => 'family',
            'description' => 'Improve family dynamics with parent-child relationships, blended family adjustment, and intergenerational healing.',
            'price' => 120.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        Service::create([
            'name' => 'Corporate Wellness',
            'slug' => 'corporate',
            'description' => 'Workplace wellness initiatives and mental health training for organizations.',
            'price' => 200.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        Service::create([
            'name' => 'Wellness Coaching',
            'slug' => 'wellness',
            'description' => 'Personalized plans for mental, physical, and spiritual wellbeing.',
            'price' => 60.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        Service::create([
            'name' => 'Spiritual Growth Session',
            'slug' => 'spiritual',
            'description' => 'Faith-based counseling and guidance for finding purpose and overcoming spiritual doubts.',
            'price' => 70.00,
            'currency' => 'USD',
            'duration_minutes' => 45,
        ]);

        // Default time slots (Mon-Sat)
        $times = [
            ['09:00', '09:45'],
            ['09:45', '10:30'],
            ['10:30', '11:15'],
            ['11:15', '12:00'],
            ['12:00', '12:45'],
            ['14:00', '14:45'],
            ['14:45', '15:30'],
            ['15:30', '16:15'],
            ['16:15', '17:00'],
            ['17:00', '17:45'],
        ];

        foreach ($times as $i => $t) {
            TimeSlot::create([
                'label' => 'Slot ' . ($i + 1),
                'day_of_week' => null,
                'start_time' => $t[0],
                'end_time' => $t[1],
            ]);
        }
    }
}
