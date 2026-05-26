<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class ClientAppointmentController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'country_code'     => 'required|string|max:10',
            'phone'            => ['required', 'string', 'max:20', 'regex:/^[\d\s\+\-\(\)]+$/', 'min_digits:6', 'max_digits:9'],
            'service_id'       => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'payment_method'   => 'required|string|max:50',
        ], [
            'phone.regex'          => 'Phone may only contain digits, spaces, +, -, ( and ).',
            'phone.min_digits'     => 'Phone number must have at least 6 digits.',
            'phone.max_digits'     => 'Phone number must not exceed 9 digits after country code.',
            'phone.required'       => 'Phone number is required.',
            'service_id.required'  => 'Please select a service.',
            'appointment_date.required' => 'Please select a date.',
            'appointment_time.required' => 'Please select a time.',
            'payment_method.required'   => 'Please select a payment method.',
        ]);

        $validated['phone'] = $validated['country_code'] . ' ' . $validated['phone'];
        $service = Service::findOrFail($validated['service_id']);

        $startTime = $validated['appointment_time'];
        $endTime = date('H:i', strtotime($startTime) + ($service->duration_minutes * 60));

        $isBooked = Appointment::where('appointment_date', $validated['appointment_date'])
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('appointment_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function ($q2) use ($startTime, $endTime) {
                      $q2->where('appointment_time', '<=', $startTime)
                         ->where('end_time', '>=', $endTime);
                  });
            })
            ->where('status', 'approved')
            ->exists();

        if ($isBooked) {
            return back()->withInput()->withErrors([
                'appointment_time' => 'This time slot overlaps with an existing booking. Please choose another time.',
            ])->with('open_booking_modal', true);
        }

        $appointment = Appointment::create([
            'user_id'          => auth()->id(),
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'phone'            => $validated['phone'],
            'service'          => $service->slug,
            'service_id'       => $service->id,
            'price'            => $service->price,
            'currency'         => $service->currency,
            'payment_method'   => $validated['payment_method'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $startTime,
            'end_time'         => $endTime,
            'status'           => 'pending',
        ]);

        Notification::notifyAdmins(
            'appointment_booked',
            'New Appointment Request',
            "{$appointment->name} booked a {$service->name} session on {$appointment->appointment_date->format('M d, Y')} at {$appointment->formatted_time_range}.",
            route('admin.appointments')
        );

        try {
            Mail::send([], [], function ($message) use ($appointment, $service) {
                $message->to('info@mindbodygoals.com')
                    ->cc('olu@mbg.qa')
                    ->subject('New Appointment Request: ' . $appointment->name)
                    ->html('
                        <h3>New Appointment Request</h3>
                        <p><strong>Client:</strong> ' . $appointment->name . '</p>
                        <p><strong>Email:</strong> ' . $appointment->email . '</p>
                        <p><strong>Phone:</strong> ' . $appointment->phone . '</p>
                        <p><strong>Service:</strong> ' . $service->name . ' (' . $service->currency . ' ' . number_format($service->price, 2) . ')</p>
                        <p><strong>Duration:</strong> ' . $service->duration_minutes . ' minutes</p>
                        <p><strong>Date:</strong> ' . $appointment->appointment_date->format('M d, Y') . '</p>
                        <p><strong>Time:</strong> ' . $appointment->formatted_time_range . '</p>
                        <p>Manage: <a href="' . route('admin.appointments') . '">Admin Panel</a></p>
                    ');
            });
        } catch (\Exception $e) {
        }

        if (auth()->check()) {
            return redirect()->route('appointment.status')
                ->with('success', 'Your appointment has been booked! We\'ll confirm shortly.');
        }
        return redirect()->route('home')
            ->with('success', 'Your appointment has been booked! We\'ll confirm shortly.');
    }

    public function showStatus()
    {
        $user = auth()->user();

        $appointments = Appointment::with('service')
            ->where('email', $user->email)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('appointment-status', compact('appointments'));
    }
}
