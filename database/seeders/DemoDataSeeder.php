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

        // --- Blog Posts ---
        $posts = [
            [
                'title' => 'Announcing Our New Book Release: My Identity — Becoming Who I Say I Am',
                'slug' => 'announcing-my-identity-book-release',
                'content' => "We are thrilled to announce the launch of Dr. Susan O. Bamidele's latest book, \"My Identity: Becoming Who I Say I Am\".\n\nThis transformative guide weaves together psychology, storytelling, and faith to help readers discover the power of self-definition and inner transformation.\n\nThrough the journey of Akello, a woman who learns to peel away false labels and embrace her true identity, this book explores:\n\n- The power of words in shaping our reality\n- The science of self-talk and cognitive reframing\n- The beauty of becoming who you were always meant to be\n\nAvailable now for pre-order. Contact us to get your copy!",
                'excerpt' => 'Discover the transformative power of self-definition in Dr. Susan O. Bamidele\'s latest book release.',
                'category' => 'Book Release',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Understanding the Connection Between Mental Health and Physical Wellness',
                'slug' => 'mental-health-physical-wellness-connection',
                'content' => "The mind-body connection is more powerful than most people realize. Research has shown that our mental state directly affects our physical health, and vice versa.\n\nAt MBG Wellness, we take a holistic approach to healing that addresses both mental and physical well-being.\n\nKey takeaways:\n\n1. Stress and anxiety can manifest as physical symptoms\n2. Regular exercise improves mood and cognitive function\n3. Nutrition plays a crucial role in mental health\n4. Quality sleep is essential for emotional regulation\n\nOur counseling services are designed to help you achieve balance in every area of your life.",
                'excerpt' => 'Explore the powerful connection between your mental and physical well-being.',
                'category' => 'Wellness',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => '5 Tips for Maintaining Emotional Wellness in a Fast-Paced World',
                'slug' => 'tips-emotional-wellness-fast-paced-world',
                'content' => "In today's fast-paced world, maintaining emotional wellness can feel like a challenge. Here are five tips to help you stay grounded:\n\n1. **Practice Mindfulness**: Take 5-10 minutes each day to sit quietly and focus on your breath.\n\n2. **Set Boundaries**: Learn to say no to things that drain your energy.\n\n3. **Stay Connected**: Maintain meaningful relationships with people who uplift you.\n\n4. **Prioritize Sleep**: Aim for 7-9 hours of quality sleep each night.\n\n5. **Seek Professional Support**: There is strength in asking for help when you need it.\n\nAt MBG Wellness, we offer professional counseling services to support your emotional well-being journey.",
                'excerpt' => 'Practical tips for staying emotionally healthy in today\'s demanding world.',
                'category' => 'Wellness Tips',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'How Counseling Can Help You Overcome Life Transitions',
                'slug' => 'counseling-life-transitions',
                'content' => "Life transitions — whether career changes, relationship shifts, or personal growth — can be challenging to navigate alone.\n\nProfessional counseling provides a safe space to:\n\n- Process complex emotions\n- Develop coping strategies\n- Gain clarity on your goals\n- Build resilience for future challenges\n\nOur experienced counselors at MBG Wellness are here to support you through every season of life.",
                'excerpt' => 'Learn how professional counseling can support you during major life changes.',
                'category' => 'Counseling',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(21),
            ],
            [
                'title' => 'Upcoming Wellness Workshop: Mind-Body Harmony',
                'slug' => 'wellness-workshop-mind-body-harmony',
                'content' => "We are excited to announce our upcoming wellness workshop: Mind-Body Harmony.\n\nDate: Coming Soon\nLocation: MBG Wellness Center\n\nThis interactive workshop will cover:\n- Guided meditation and breathing exercises\n- Understanding the stress response\n- Practical tools for daily wellness\n- Group discussions and Q&A\n\nSpaces are limited. Contact us to register your interest!",
                'excerpt' => 'Join us for an interactive workshop on achieving mind-body harmony.',
                'category' => 'Events',
                'author' => 'MBG Wellness',
                'status' => 'draft',
                'published_at' => null,
            ],
            [
                'title' => 'New Book Release: Healing Through Faith and Psychology',
                'slug' => 'healing-through-faith-psychology',
                'content' => "Dr. Susan O. Bamidele's upcoming book explores the powerful intersection of faith and evidence-based psychology in the healing process.\n\nThis new release combines:\n- Biblical principles of restoration\n- Cognitive behavioral therapy techniques\n- Mindfulness and meditation practices\n- Practical exercises for daily growth\n\nStay tuned for the official release date!",
                'excerpt' => 'A groundbreaking new book combining faith and psychology for holistic healing.',
                'category' => 'Book Release',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Introducing Our New Book: The Mindful Journey to Inner Peace',
                'slug' => 'mindful-journey-inner-peace',
                'content' => "We are proud to announce our newest publication, 'The Mindful Journey to Inner Peace'.\n\nThis book offers:\n- Daily mindfulness exercises\n- Guided meditation scripts\n- Journaling prompts for self-discovery\n- Techniques for managing anxiety and stress\n\nPerfect for anyone seeking calm and clarity in a chaotic world.",
                'excerpt' => 'Discover practical mindfulness techniques for lasting inner peace in our newest release.',
                'category' => 'Book Release',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'The Role of Nutrition in Mental Health',
                'slug' => 'nutrition-mental-health',
                'content' => "What we eat directly impacts how we feel. Emerging research continues to demonstrate the critical role nutrition plays in mental health.\n\nKey nutrients for brain health:\n- Omega-3 fatty acids for mood regulation\n- B vitamins for energy and focus\n- Vitamin D for depression prevention\n- Probiotics for the gut-brain connection\n\nLearn how small dietary changes can make a big difference in your mental well-being.",
                'excerpt' => 'How your diet affects your mood, focus, and overall mental well-being.',
                'category' => 'Wellness',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Building Resilience: A Guide for Modern Professionals',
                'slug' => 'building-resilience-guide',
                'content' => "In today's fast-paced work environment, resilience is more important than ever.\n\nHere are strategies to build mental toughness:\n1. Develop a growth mindset\n2. Practice self-compassion\n3. Build strong support networks\n4. Maintain work-life boundaries\n5. Prioritize physical health\n\nOur corporate wellness programs are designed to help teams build resilience together.",
                'excerpt' => 'Practical strategies for building mental toughness in the workplace.',
                'category' => 'Wellness Tips',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Understanding Anxiety: Signs, Symptoms, and Solutions',
                'slug' => 'understanding-anxiety',
                'content' => "Anxiety affects millions of people worldwide, but understanding it is the first step to managing it.\n\nCommon symptoms include:\n- Persistent worry\n- Racing thoughts\n- Physical tension\n- Sleep difficulties\n- Avoidance behaviors\n\nProfessional counseling can provide effective tools for managing anxiety. At MBG Wellness, we offer personalized treatment plans tailored to your needs.",
                'excerpt' => 'Learn to recognize the signs of anxiety and discover effective solutions.',
                'category' => 'Counseling',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'New Release: Overcoming Self-Doubt Through Faith',
                'slug' => 'overcoming-self-doubt-faith',
                'content' => "Our latest book release tackles one of the most common struggles: self-doubt.\n\nThis book guides readers through:\n- Identifying the root causes of self-doubt\n- Biblical principles for building confidence\n- Practical exercises for daily affirmation\n- Stories of transformation and hope\n\nAvailable for pre-order now!",
                'excerpt' => 'A powerful new book on building unshakeable confidence through faith.',
                'category' => 'Book Release',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'New Book: The Art of Mindful Parenting',
                'slug' => 'art-of-mindful-parenting',
                'content' => "Parenting is one of life's greatest challenges and joys. Our new book, 'The Art of Mindful Parenting', offers practical guidance for raising emotionally healthy children.\n\nTopics covered:\n- Understanding your child's emotional needs\n- Mindful communication techniques\n- Setting boundaries with love\n- Managing parental stress\n\nA must-read for every parent!",
                'excerpt' => 'Practical guidance for raising emotionally healthy children through mindful parenting.',
                'category' => 'Book Release',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Managing Stress in a Digital Age',
                'slug' => 'managing-stress-digital-age',
                'content' => "Constant connectivity is taking a toll on our mental health. Here's how to manage stress in a digital world:\n\n1. Set digital boundaries\n2. Practice regular digital detoxes\n3. Use technology mindfully\n4. Prioritize face-to-face connections\n5. Create tech-free zones in your home\n\nOur counselors can help you develop a healthier relationship with technology.",
                'excerpt' => 'Practical tips for managing stress and finding balance in our hyper-connected world.',
                'category' => 'Wellness Tips',
                'author' => 'Dr. Susan O. Bamidele',
                'status' => 'published',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'The Benefits of Group Therapy',
                'slug' => 'benefits-group-therapy',
                'content' => "Group therapy offers unique benefits that individual counseling cannot provide.\n\nBenefits include:\n- Shared experiences and support\n- Diverse perspectives\n- Social skill development\n- Cost-effective treatment\n- Accountability and motivation\n\nContact MBG Wellness to learn about our upcoming group therapy sessions.",
                'excerpt' => 'Discover how group therapy can complement your mental health journey.',
                'category' => 'Counseling',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(9),
            ],
            [
                'title' => 'Seasonal Affective Disorder: What You Need to Know',
                'slug' => 'seasonal-affective-disorder',
                'content' => "As seasons change, many people experience shifts in mood and energy levels. Seasonal Affective Disorder (SAD) is a real condition that affects millions.\n\nSymptoms:\n- Low energy and fatigue\n- Changes in sleep patterns\n- Cravings for carbohydrates\n- Weight gain\n- Social withdrawal\n\nTreatment options include light therapy, counseling, and lifestyle adjustments.",
                'excerpt' => 'Understanding and managing seasonal depression for better year-round mental health.',
                'category' => 'Wellness',
                'author' => 'MBG Wellness',
                'status' => 'published',
                'published_at' => now()->subDays(11),
            ],
        ];

        foreach ($posts as $p) {
            \App\Models\Post::create($p);
        }
    }
}
