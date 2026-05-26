<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Purchase;
use App\Models\Notification;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all()->keyBy('email');
        $admin = $users['admin@mindbodygoals.com'];
        $demo = $users['client@example.com'];

        // Create additional clients
        $sarah = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $james = User::create([
            'name' => 'James Mwangi',
            'email' => 'james@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $books = Book::all();
        $services = Service::all();
        $today = now();

        // ──────────────────────────────────────────────
        // APPOINTMENTS
        // ──────────────────────────────────────────────

        // Demo Client — mix of statuses
        $app1 = Appointment::create([
            'user_id'          => $demo->id,
            'name'             => $demo->name,
            'email'            => $demo->email,
            'phone'            => '+255 987 678 987',
            'service'          => $services[0]->slug,
            'service_id'       => $services[0]->id,
            'price'            => $services[0]->price,
            'currency'         => $services[0]->currency,
            'payment_method'   => 'mpesa',
            'appointment_date' => $today->copy()->addDays(2),
            'appointment_time' => '09:00',
            'end_time'         => '09:45',
            'status'           => 'approved',
            'notes'            => 'Client has been making great progress with cognitive behavioral techniques.',
        ]);

        $app2 = Appointment::create([
            'user_id'          => $demo->id,
            'name'             => $demo->name,
            'email'            => $demo->email,
            'phone'            => '+255 987 678 987',
            'service'          => $services[2]->slug,
            'service_id'       => $services[2]->id,
            'price'            => $services[2]->price,
            'currency'         => $services[2]->currency,
            'payment_method'   => 'card',
            'appointment_date' => $today->copy()->addDays(5),
            'appointment_time' => '14:00',
            'end_time'         => '14:45',
            'status'           => 'pending',
        ]);

        $app3 = Appointment::create([
            'user_id'          => $demo->id,
            'name'             => $demo->name,
            'email'            => $demo->email,
            'phone'            => '+255 987 678 987',
            'service'          => $services[4]->slug,
            'service_id'       => $services[4]->id,
            'price'            => $services[4]->price,
            'currency'         => $services[4]->currency,
            'payment_method'   => 'cash',
            'appointment_date' => $today->copy()->subDays(3),
            'appointment_time' => '10:30',
            'end_time'         => '11:15',
            'status'           => 'declined',
            'notes'            => 'Unfortunately, the requested time slot is no longer available. Please contact the client to reschedule.',
        ]);

        $app4 = Appointment::create([
            'user_id'          => $demo->id,
            'name'             => $demo->name,
            'email'            => $demo->email,
            'phone'            => '+255 987 678 987',
            'service'          => $services[1]->slug,
            'service_id'       => $services[1]->id,
            'price'            => $services[1]->price,
            'currency'         => $services[1]->currency,
            'payment_method'   => 'mpesa',
            'appointment_date' => $today->copy()->subDays(7),
            'appointment_time' => '11:15',
            'end_time'         => '12:00',
            'status'           => 'completed',
            'notes'            => 'Excellent session. Client reported significant improvement in communication with partner. Follow-up recommended in 2 weeks.',
        ]);

        // Sarah — pending + approved
        Appointment::create([
            'user_id'          => $sarah->id,
            'name'             => $sarah->name,
            'email'            => $sarah->email,
            'phone'            => '+255 712 345 678',
            'service'          => $services[0]->slug,
            'service_id'       => $services[0]->id,
            'price'            => $services[0]->price,
            'currency'         => $services[0]->currency,
            'payment_method'   => 'airtel_money',
            'appointment_date' => $today->copy()->addDays(3),
            'appointment_time' => '15:30',
            'end_time'         => '16:15',
            'status'           => 'pending',
        ]);

        Appointment::create([
            'user_id'          => $sarah->id,
            'name'             => $sarah->name,
            'email'            => $sarah->email,
            'phone'            => '+255 712 345 678',
            'service'          => $services[5]->slug,
            'service_id'       => $services[5]->id,
            'price'            => $services[5]->price,
            'currency'         => $services[5]->currency,
            'payment_method'   => 'mpesa',
            'appointment_date' => $today->copy()->addDays(10),
            'appointment_time' => '09:45',
            'end_time'         => '10:30',
            'status'           => 'approved',
        ]);

        // James — one pending
        Appointment::create([
            'user_id'          => $james->id,
            'name'             => $james->name,
            'email'            => $james->email,
            'phone'            => '+255 723 456 789',
            'service'          => $services[3]->slug,
            'service_id'       => $services[3]->id,
            'price'            => $services[3]->price,
            'currency'         => $services[3]->currency,
            'payment_method'   => 'card',
            'appointment_date' => $today->copy()->addDays(7),
            'appointment_time' => '16:15',
            'end_time'         => '17:00',
            'status'           => 'pending',
        ]);

        // ──────────────────────────────────────────────
        // ORDERS + ORDER ITEMS
        // ──────────────────────────────────────────────

        // Demo Client — completed order (2 books)
        $order1 = Order::create([
            'user_id'           => $demo->id,
            'order_number'      => 'MBG-2026-0001',
            'invoice_number'    => 'INV-2026-0001',
            'status'            => 'completed',
            'subtotal'          => 25.49,
            'shipping'          => 5.00,
            'tax'               => 0,
            'total'             => 30.49,
            'currency'          => 'USD',
            'billing_name'      => $demo->name,
            'billing_email'     => $demo->email,
            'billing_phone'     => '+255 987 678 987',
            'billing_address'   => '123 Main Street',
            'billing_city'      => 'Dar es Salaam',
            'billing_state'     => 'Dar es Salaam',
            'billing_zip'       => '14111',
            'billing_country'   => 'Tanzania',
            'shipping_name'     => $demo->name,
            'shipping_email'    => $demo->email,
            'shipping_phone'    => '+255 987 678 987',
            'shipping_address'  => '123 Main Street',
            'shipping_city'     => 'Dar es Salaam',
            'shipping_state'    => 'Dar es Salaam',
            'shipping_zip'      => '14111',
            'shipping_country'  => 'Tanzania',
            'payment_method'    => 'mpesa',
            'payment_status'    => 'paid',
            'notes'             => 'Delivered to reception.',
            'shipped_at'        => $today->copy()->subDays(5),
            'delivered_at'      => $today->copy()->subDays(4),
        ]);

        OrderItem::create([
            'order_id'       => $order1->id,
            'orderable_id'   => $books[0]->id,
            'orderable_type' => Book::class,
            'title'          => $books[0]->title,
            'price'          => $books[0]->price,
            'quantity'       => 1,
            'total'          => $books[0]->price,
        ]);

        OrderItem::create([
            'order_id'       => $order1->id,
            'orderable_id'   => $books[3]->id,
            'orderable_type' => Book::class,
            'title'          => $books[3]->title,
            'price'          => $books[3]->price,
            'quantity'       => 1,
            'total'          => $books[3]->price,
        ]);

        Purchase::create([
            'user_id'       => $demo->id,
            'book_id'       => $books[0]->id,
            'buyer_name'    => $demo->name,
            'buyer_email'   => $demo->email,
            'buyer_phone'   => '+255 987 678 987',
            'payment_method' => 'mpesa',
            'status'        => 'completed',
            'price'         => $books[0]->price,
            'currency'      => $books[0]->currency,
        ]);

        Purchase::create([
            'user_id'       => $demo->id,
            'book_id'       => $books[3]->id,
            'buyer_name'    => $demo->name,
            'buyer_email'   => $demo->email,
            'buyer_phone'   => '+255 987 678 987',
            'payment_method' => 'mpesa',
            'status'        => 'completed',
            'price'         => $books[3]->price,
            'currency'      => $books[3]->currency,
        ]);

        // Demo Client — pending order (1 digital book)
        $order2 = Order::create([
            'user_id'           => $demo->id,
            'order_number'      => 'MBG-2026-0002',
            'invoice_number'    => 'INV-2026-0002',
            'status'            => 'pending',
            'subtotal'          => 9.99,
            'shipping'          => 0,
            'tax'               => 0,
            'total'             => 9.99,
            'currency'          => 'USD',
            'billing_name'      => $demo->name,
            'billing_email'     => $demo->email,
            'billing_phone'     => '+255 987 678 987',
            'billing_address'   => '123 Main Street',
            'billing_city'      => 'Dar es Salaam',
            'billing_state'     => 'Dar es Salaam',
            'billing_zip'       => '14111',
            'billing_country'   => 'Tanzania',
            'payment_method'    => 'card',
            'payment_status'    => 'pending',
        ]);

        OrderItem::create([
            'order_id'       => $order2->id,
            'orderable_id'   => $books[2]->id,
            'orderable_type' => Book::class,
            'title'          => $books[2]->title,
            'price'          => $books[2]->price,
            'quantity'       => 1,
            'total'          => $books[2]->price,
        ]);

        Purchase::create([
            'user_id'       => $demo->id,
            'book_id'       => $books[2]->id,
            'buyer_name'    => $demo->name,
            'buyer_email'   => $demo->email,
            'buyer_phone'   => '+255 987 678 987',
            'payment_method' => 'card',
            'status'        => 'pending',
            'price'         => $books[2]->price,
            'currency'      => $books[2]->currency,
        ]);

        // Sarah — completed order (1 book)
        $order3 = Order::create([
            'user_id'           => $sarah->id,
            'order_number'      => 'MBG-2026-0003',
            'invoice_number'    => 'INV-2026-0003',
            'status'            => 'completed',
            'subtotal'          => 14.99,
            'shipping'          => 0,
            'tax'               => 0,
            'total'             => 14.99,
            'currency'          => 'USD',
            'billing_name'      => $sarah->name,
            'billing_email'     => $sarah->email,
            'billing_phone'     => '+255 712 345 678',
            'billing_address'   => '456 Oak Avenue',
            'billing_city'      => 'Nairobi',
            'billing_state'     => 'Nairobi',
            'billing_zip'       => '00100',
            'billing_country'   => 'Kenya',
            'payment_method'    => 'airtel_money',
            'payment_status'    => 'paid',
        ]);

        OrderItem::create([
            'order_id'       => $order3->id,
            'orderable_id'   => $books[4]->id,
            'orderable_type' => Book::class,
            'title'          => $books[4]->title,
            'price'          => $books[4]->price,
            'quantity'       => 1,
            'total'          => $books[4]->price,
        ]);

        Purchase::create([
            'user_id'       => $sarah->id,
            'book_id'       => $books[4]->id,
            'buyer_name'    => $sarah->name,
            'buyer_email'   => $sarah->email,
            'buyer_phone'   => '+255 712 345 678',
            'payment_method' => 'airtel_money',
            'status'        => 'completed',
            'price'         => $books[4]->price,
            'currency'      => $books[4]->currency,
        ]);

        // ──────────────────────────────────────────────
        // NOTIFICATIONS
        // ──────────────────────────────────────────────

        // Admin notifications
        $adminNotifications = [
            ['type' => 'appointment_booked', 'title' => 'New Appointment Request', 'message' => "{$demo->name} booked an Individual Therapy session for {$app2->appointment_date->format('M d, Y')} at 14:00 — 14:45.", 'url' => '/admin/appointments'],
            ['type' => 'appointment_booked', 'title' => 'New Appointment Request', 'message' => "{$sarah->name} booked a Spiritual Growth Session for {$today->copy()->addDays(10)->format('M d, Y')} at 09:45 — 10:30.", 'url' => '/admin/appointments'],
            ['type' => 'order_placed', 'title' => 'New Order Received', 'message' => "Order MBG-2026-0002 from {$demo->name} — {$order2->total} {$order2->currency}.", 'url' => '/admin/orders'],
        ];

        foreach ($adminNotifications as $n) {
            Notification::createForUser($admin->id, $n['type'], $n['title'], $n['message'], $n['url']);
        }

        // Demo client notifications
        $clientNotifications = [
            ['type' => 'appointment_approved', 'title' => 'Appointment Approved', 'message' => "Your Individual Therapy session on {$app1->appointment_date->format('M d, Y')} at 09:00 — 09:45 has been approved.", 'url' => '/appointment-status'],
            ['type' => 'appointment_declined', 'title' => 'Appointment Declined', 'message' => "Your Wellness Coaching session on {$today->copy()->subDays(3)->format('M d, Y')} could not be accommodated. Please book a different time.", 'url' => '/appointment-status'],
            ['type' => 'order_status', 'title' => 'Order Completed', 'message' => "Your order MBG-2026-0001 has been delivered. Thank you for your purchase!", 'url' => '/orders/' . $order1->id],
            ['type' => 'appointment_approved', 'title' => 'Appointment Approved', 'message' => "Your Family Therapy session on {$today->copy()->addDays(5)->format('M d, Y')} at 14:00 — 14:45 has been approved.", 'url' => '/appointment-status'],
        ];

        foreach ($clientNotifications as $n) {
            Notification::createForUser($demo->id, $n['type'], $n['title'], $n['message'], $n['url']);
        }
    }
}
