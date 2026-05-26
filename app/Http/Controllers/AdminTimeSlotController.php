<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;

class AdminTimeSlotController extends Controller
{
    public function index()
    {
        $timeSlots = TimeSlot::orderBy('day_of_week')->orderBy('start_time')->paginate(15);
        return view('admin.time-slots', compact('timeSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'nullable|string|max:255',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        TimeSlot::create($validated);

        return back()->with('success', 'Time slot created successfully.');
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validated = $request->validate([
            'label' => 'nullable|string|max:255',
            'day_of_week' => 'nullable|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $timeSlot->update($validated);

        return back()->with('success', 'Time slot updated successfully.');
    }

    public function destroy(TimeSlot $timeSlot)
    {
        $timeSlot->delete();
        return back()->with('success', 'Time slot deleted successfully.');
    }
}
