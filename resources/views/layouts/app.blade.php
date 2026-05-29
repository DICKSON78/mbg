<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mind, Body & Goals | Premium Counseling & Wellness')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #842988 0%, #6a1b9a 100%);
        }
        
        .text-gradient {
            background: linear-gradient(90deg, #fcd91b 0%, #ffeb3b 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #fcd91b;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .service-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .book-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .whatsapp-btn {
            box-shadow: 0 10px 15px -3px rgba(25, 175, 80, 0.3);
            transition: all 0.3s ease;
        }
        
        .whatsapp-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 20px 25px -5px rgba(25, 175, 80, 0.4);
        }

        .hero-pattern {
            background-image: radial-gradient(rgba(132, 41, 136, 0.2) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .testimonial-card {
            background: linear-gradient(145deg, #ffffff 0%, #f9f9f9 100%);
        }

        .service-icon {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .service-card:hover .service-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .book-icon {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .book-card:hover .book-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .book-cover {
            transition: all 0.3s ease;
        }
        
        .book-cover:hover {
            transform: scale(1.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Mobile Menu Styles */
        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: #1a1a1a;
            border-bottom: 1px solid #f3f4f6;
        }

        .mobile-menu a:hover {
            color: #842988;
            background-color: #f9fafb;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
        }

        .mobile-menu-button {
            transition: all 0.3s ease;
        }

        .mobile-menu-button:hover {
            color: #842988;
            transform: scale(1.1);
        }

        nav {
            z-index: 1000;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#842988',
                        secondary: '#fcd91b',
                        accent: '#909291',
                        dark: '#1a1a1a',
                        light: '#f8f9fa'
                    },
                    animation: {
                        'float-slow': 'floating 6s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/255792326665" target="_blank" class="fixed bottom-8 right-8 z-50 whatsapp-btn bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl shadow-lg animate-bounce">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Navigation -->
    <nav class="fixed w-full bg-white shadow-md z-40 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/img/favicon.png') }}" alt="Mind, Body & Goals Logo" class="h-10">
                <div class="text-xl font-bold text-primary">MIND, BODY & GOALS</div>
            </a>
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">About</a>
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">Services</a>
                <a href="{{ route('books') }}" class="nav-link {{ request()->routeIs('books') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">My Publications</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">Blog</a>
                <a href="{{ route('testimonials') }}" class="nav-link {{ request()->routeIs('testimonials') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">Testimonials</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-primary font-medium' : 'text-dark' }} hover:text-primary">Contact</a>

                <a href="javascript:void(0)" onclick="openBookModal()" class="bg-primary hover:bg-opacity-90 text-white px-5 py-2 rounded-full transition-all shadow-lg hover:shadow-xl text-sm font-semibold text-center inline-block">Book Session</a>

                <a href="javascript:void(0)" onclick="openCartOrModal()" class="relative nav-link text-dark hover:text-primary">
                    <i class="fas fa-shopping-bag text-lg"></i>
                    <span id="cart-count-desktop" class="absolute -top-2 -right-3 bg-primary text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">0</span>
                </a>

                @auth
                    <div class="relative" id="notif-dropdown">
                        <button onclick="toggleNotifDropdown()" class="relative nav-link text-dark hover:text-primary">
                            <i class="fas fa-bell text-lg"></i>
                            <span id="notif-count" class="absolute -top-2 -right-3 bg-red-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center hidden">0</span>
                        </button>
                        <div id="notif-dropdown-menu" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden max-h-96 overflow-y-auto">
                            <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-100">Notifications</div>
                            <div id="notif-list" class="divide-y divide-gray-50">
                                <div class="px-4 py-6 text-center text-sm text-gray-400">Loading...</div>
                            </div>
                            <a href="#" class="block px-4 py-2 text-xs text-center text-primary hover:bg-gray-50 font-medium border-t border-gray-100">View All</a>
                        </div>
                    </div>

                    <div class="relative" id="user-dropdown">
                        <button onclick="toggleUserDropdown()" class="w-9 h-9 rounded-full bg-primary text-white font-bold text-sm flex items-center justify-center hover:opacity-90 transition shadow-md cursor-pointer ring-2 ring-white ring-offset-1 ring-offset-transparent">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                        <div id="user-dropdown-menu" class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50 hidden">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium transition"><i class="fas fa-chart-pie w-4 text-center text-gray-400"></i> My Dashboard</a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium transition"><i class="fas fa-user w-4 text-center text-gray-400"></i> Profile</a>
                                <hr class="my-1 border-gray-100">
                                <a href="{{ route('admin.logout') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition"><i class="fas fa-sign-out-alt w-4 text-center"></i> Sign Out</a>
                            @else
                                <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium transition"><i class="fas fa-chart-pie w-4 text-center text-gray-400"></i> My Dashboard</a>
                                <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium transition"><i class="fas fa-user w-4 text-center text-gray-400"></i> Profile</a>
                                <hr class="my-1 border-gray-100">
                                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium transition"><i class="fas fa-sign-out-alt w-4 text-center"></i> Sign Out</a>
                            @endif
                        </div>
                    </div>
                @else
                    <a href="javascript:void(0)" onclick="openAuthModal('login')" class="bg-dark hover:bg-opacity-90 text-white px-5 py-2 rounded-full transition-all text-sm font-semibold shadow-lg hover:shadow-xl text-center inline-block">Sign In</a>
                @endauth
            </div>
            <div class="lg:hidden">
                <button class="mobile-menu-button text-dark focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="mobile-menu lg:hidden">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-primary font-medium' : 'text-gray-600' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-primary font-medium' : 'text-gray-600' }}">About</a>
            <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'text-primary font-medium' : 'text-gray-600' }}">Services</a>
            <a href="{{ route('books') }}" class="nav-link {{ request()->routeIs('books') ? 'text-primary font-medium' : 'text-gray-600' }}">My Publications</a>
            <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'text-primary font-medium' : 'text-gray-600' }}">Blog</a>
            <a href="{{ route('testimonials') }}" class="nav-link {{ request()->routeIs('testimonials') ? 'text-primary font-medium' : 'text-gray-600' }}">Testimonials</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-primary font-medium' : 'text-gray-600' }}">Contact</a>
            <a href="javascript:void(0)" onclick="openBookModal()" class="bg-primary text-white px-4 py-2 rounded-full block text-center mt-2 font-semibold text-sm">Book Session</a>
            <a href="javascript:void(0)" onclick="openCartOrModal()" class="nav-link text-gray-600 flex items-center">
                <i class="fas fa-shopping-bag mr-2"></i> Cart <span id="cart-count-mobile" class="ml-1 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
            </a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="bg-dark text-white px-4 py-2 rounded-full block text-center mt-2 font-semibold text-sm">My Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link text-gray-600 block text-center mt-2 text-sm">Profile</a>
                    <a href="{{ route('admin.logout') }}" class="nav-link text-gray-600 block text-center mt-2 text-sm">Sign Out</a>
                @else
                    <a href="{{ route('profile') }}" class="bg-dark text-white px-4 py-2 rounded-full block text-center mt-2 font-semibold text-sm">My Dashboard</a>
                    <a href="{{ route('profile') }}" class="nav-link text-gray-600 block text-center mt-2 text-sm">Profile</a>
                    <a href="{{ route('logout') }}" class="nav-link text-gray-600 block text-center mt-2 text-sm">Sign Out</a>
                @endif
            @else
                <a href="javascript:void(0)" onclick="openAuthModal('login')" class="bg-dark text-white px-4 py-2 rounded-full block text-center mt-2 font-semibold text-sm">Sign In</a>
            @endauth
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('assets/img/favicon.png') }}" alt="Mind, Body & Goals Logo" class="h-10">
                        <div class="text-xl font-bold">MIND, BODY & GOALS</div>
                    </div>
                    <p class="text-gray-400 mb-4">Holistic counseling and wellness services for emotional healing and personal growth.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">About</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition">Services</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="{{ route('testimonials') }}" class="text-gray-400 hover:text-white transition">Testimonials</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('services') }}#counseling" class="text-gray-400 hover:text-white transition">Individual Therapy</a></li>
                        <li><a href="{{ route('services') }}#counseling" class="text-gray-400 hover:text-white transition">Couples Counseling</a></li>
                        <li><a href="{{ route('services') }}#counseling" class="text-gray-400 hover:text-white transition">Family Therapy</a></li>
                        <li><a href="{{ route('services') }}#wellness" class="text-gray-400 hover:text-white transition">Wellness Coaching</a></li>
                        <li><a href="{{ route('services') }}#corporate" class="text-gray-400 hover:text-white transition">Corporate Programs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Contact Info</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary"></i>
                            <div>
                                <span>Dodoma, Tanzania</span><br>
                                <span>Unit U2, Building No. 138, Umm Al Roos Street, Zone 66, Dafna Area, Doha, Qatar</span>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-primary"></i>
                            <div>
                                <span>+255 792 326 665 (Tanzania)</span><br>
                                <span>+974 5579 1039 (Qatar)</span>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-primary"></i>
                            <div>
                                <span>info@mindbodygoals.com</span><br>
                                <span>olu@mbg.qa</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">© <span id="currentYear"></span> Mind, Body & Goals. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const icon = mobileMenuButton.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking a link
        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileMenuButton.querySelector('i').classList.remove('fa-times');
                mobileMenuButton.querySelector('i').classList.add('fa-bars');
            });
        });
        
        // FAQ accordion
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('i');
                
                answer.classList.toggle('hidden');
                icon.classList.toggle('transform');
                icon.classList.toggle('rotate-180');
            });
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                // If it's just a regular hash link on the same page
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#')) {
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        
                        // Close mobile menu if open
                        if (mobileMenu.classList.contains('active')) {
                            mobileMenu.classList.remove('active');
                            mobileMenuButton.querySelector('i').classList.remove('fa-times');
                            mobileMenuButton.querySelector('i').classList.add('fa-bars');
                        }
                    }
                }
            });
        });
        
        // Scroll animation for elements
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.service-card, .book-card, .hover-scale');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementPosition < windowHeight - 100) {
                    element.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
        
        // Dynamic year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Update cart count
        function updateCartCount() {
            fetch('/cart/count')
                .then(r => r.json())
                .then(data => {
                    const count = data.count || 0;
                    const desktop = document.getElementById('cart-count-desktop');
                    const mobile = document.getElementById('cart-count-mobile');
                    if (desktop) desktop.textContent = count;
                    if (mobile) mobile.textContent = count;
                })
                .catch(() => {});
        }
        updateCartCount();

        // User dropdown toggle
        let userDropdownOpen = false;
        function toggleUserDropdown() {
            userDropdownOpen = !userDropdownOpen;
            const menu = document.getElementById('user-dropdown-menu');
            if (menu) menu.classList.toggle('hidden', !userDropdownOpen);
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown && !dropdown.contains(e.target) && userDropdownOpen) {
                userDropdownOpen = false;
                const menu = document.getElementById('user-dropdown-menu');
                if (menu) menu.classList.add('hidden');
            }
            const notifDropdown = document.getElementById('notif-dropdown');
            if (notifDropdown && !notifDropdown.contains(e.target) && notifDropdownOpen) {
                notifDropdownOpen = false;
                const menu = document.getElementById('notif-dropdown-menu');
                if (menu) menu.classList.add('hidden');
            }
        });

        // Notification dropdown toggle
        let notifDropdownOpen = false;
        function toggleNotifDropdown() {
            notifDropdownOpen = !notifDropdownOpen;
            const menu = document.getElementById('notif-dropdown-menu');
            if (menu) menu.classList.toggle('hidden', !notifDropdownOpen);
            if (notifDropdownOpen) fetchNotifications();
        }

        // Fetch notifications
        function fetchNotifications() {
            fetch('/notifications')
                .then(r => r.json())
                .then(data => {
                    const list = document.getElementById('notif-list');
                    const countBadge = document.getElementById('notif-count');
                    if (data.unread_count > 0) {
                        countBadge.classList.remove('hidden');
                        countBadge.textContent = data.unread_count;
                    } else {
                        countBadge.classList.add('hidden');
                    }
                    if (data.notifications.length === 0) {
                        list.innerHTML = '<div class="px-4 py-6 text-center text-sm text-gray-400">No notifications yet.</div>';
                        return;
                    }
                    list.innerHTML = data.notifications.map(n => {
                        const icons = { appointment_booked: 'fa-calendar-plus', appointment_approved: 'fa-check-circle', appointment_declined: 'fa-times-circle', order_placed: 'fa-shopping-bag', order_status: 'fa-truck' };
                        const icon = icons[n.type] || 'fa-bell';
                        return '<a href="' + (n.url || '#') + '" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition ' + (n.is_read ? '' : 'bg-blue-50/30') + '" onclick="markNotifRead(' + n.id + ')">' +
                            '<div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0 mt-0.5"><i class="fas ' + icon + ' text-xs text-primary"></i></div>' +
                            '<div class="flex-1 min-w-0"><p class="text-sm font-medium text-gray-800">' + n.title + '</p><p class="text-xs text-gray-500 mt-0.5 line-clamp-2">' + (n.message || '') + '</p></div>' +
                            '</a>';
                    }).join('');
                })
                .catch(() => {});
        }

        function markNotifRead(id) {
            fetch('/notifications/' + id + '/read', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' } })
                .then(() => fetchNotifications())
                .catch(() => {});
        }

        // Initial notification check
        setTimeout(fetchNotifications, 2000);
    </script>

    <!-- Client Login & Register Modal -->
    <div id="authModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300">
            <!-- Tabs Header -->
            <div class="flex border-b border-gray-150 bg-gray-50">
                <button onclick="switchAuthTab('login')" id="tab-login-btn" class="w-1/2 py-4 text-center font-bold text-sm border-b-2 border-primary text-primary focus:outline-none transition-all">
                    Sign In
                </button>
                <button onclick="switchAuthTab('register')" id="tab-register-btn" class="w-1/2 py-4 text-center font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-primary focus:outline-none transition-all">
                    Create Account
                </button>
                <button onclick="closeAuthModal()" class="px-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Login Form Container -->
            <div id="auth-login-section" class="p-6">
                <h3 class="text-xl font-bold text-dark mb-2">Welcome Back</h3>
                <p class="text-xs text-gray-500 mb-6">Log in to view your publications, appointment schedule, and clinician notes.</p>
                
                @if($errors->has('login_error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded text-xs">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif
                @if($errors->has('email') && !old('name'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded text-xs">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-4" onsubmit="return handleFormSubmit(this, 'Signing In...')">
                    @csrf
                    <div>
                        <label for="login_email" class="block text-xs font-semibold text-gray-600 mb-1">Email Address</label>
                        <input type="email" id="login_email" name="email" required value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <div>
                        <label for="login_password" class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                        <input type="password" id="login_password" name="password" required
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-[#6a1b9a] text-white py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Register Form Container -->
            <div id="auth-register-section" class="p-6 hidden">
                <h3 class="text-xl font-bold text-dark mb-2">Join MBG Wellness</h3>
                <p class="text-xs text-gray-500 mb-6">Create an account to manage your appointment history, view purchases, and track notes.</p>

                @if($errors->any() && old('name'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded text-xs">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" class="space-y-4" onsubmit="return handleFormSubmit(this, 'Creating Account...')">
                    @csrf
                    <div>
                        <label for="reg_name" class="block text-xs font-semibold text-gray-600 mb-1">Full Name</label>
                        <input type="text" id="reg_name" name="name" required value="{{ old('name') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <div>
                        <label for="reg_email" class="block text-xs font-semibold text-gray-600 mb-1">Email Address</label>
                        <input type="email" id="reg_email" name="email" required
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <div>
                        <label for="reg_password" class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                        <input type="password" id="reg_password" name="password" required
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <div>
                        <label for="reg_password_conf" class="block text-xs font-semibold text-gray-600 mb-1">Confirm Password</label>
                        <input type="password" id="reg_password_conf" name="password_confirmation" required
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-[#6a1b9a] text-white py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                        Register Account
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const authModal = document.getElementById('authModal');
        const loginSection = document.getElementById('auth-login-section');
        const registerSection = document.getElementById('auth-register-section');
        const tabLoginBtn = document.getElementById('tab-login-btn');
        const tabRegisterBtn = document.getElementById('tab-register-btn');

        function handleFormSubmit(form, text) {
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> ' + text;
            return true;
        }

        function openAuthModal(tab = 'login') {
            authModal.classList.remove('hidden');
            switchAuthTab(tab);
        }

        function closeAuthModal() {
            authModal.classList.add('hidden');
        }

        function switchAuthTab(tab) {
            if (tab === 'login') {
                loginSection.classList.remove('hidden');
                registerSection.classList.add('hidden');
                tabLoginBtn.classList.add('border-primary', 'text-primary');
                tabLoginBtn.classList.remove('border-transparent', 'text-gray-500');
                tabRegisterBtn.classList.remove('border-primary', 'text-primary');
                tabRegisterBtn.classList.add('border-transparent', 'text-gray-500');
            } else {
                loginSection.classList.add('hidden');
                registerSection.classList.remove('hidden');
                tabRegisterBtn.classList.add('border-primary', 'text-primary');
                tabRegisterBtn.classList.remove('border-transparent', 'text-gray-500');
                tabLoginBtn.classList.remove('border-primary', 'text-primary');
                tabLoginBtn.classList.add('border-transparent', 'text-gray-500');
            }
        }
    </script>

    @if(session('open_login_modal') || $errors->has('login_error') || ($errors->has('email') && !old('name')))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                openAuthModal('login');
            });
        </script>
    @elseif($errors->any() && old('name'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                openAuthModal('register');
            });
        </script>
    @endif

    <!-- Book Session Modal (3-Step Wizard) -->
    @php
        $bsServices = \App\Models\Service::where('is_active', true)->get();
        $bsTimeSlots = \App\Models\TimeSlot::where('is_active', true)->orderBy('start_time')->get();
        $bsUser = auth()->user();
    @endphp
    <div id="bookModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all duration-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-dark flex items-center gap-2"><i class="fas fa-calendar-plus text-primary"></i> Book a Session</h3>
                <button onclick="closeBookModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times"></i></button>
            </div>

            @if ($errors->any() && old('_booking'))
                <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step Indicator -->
            <div class="px-6 pt-6 pb-2">
                <div class="flex items-center justify-center gap-0">
                    <div class="flex items-center">
                        <div id="bs-step1-circle" class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold transition-all duration-300">1</div>
                        <div id="bs-step1-line" class="w-12 h-0.5 bg-gray-200 transition-all duration-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div id="bs-step2-circle" class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-bold transition-all duration-300">2</div>
                        <div id="bs-step2-line" class="w-12 h-0.5 bg-gray-200 transition-all duration-300"></div>
                    </div>
                    <div class="flex items-center">
                        <div id="bs-step3-circle" class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-bold transition-all duration-300">3</div>
                    </div>
                </div>
                <div class="flex justify-center gap-0 mt-1.5 text-[10px] font-medium text-gray-400">
                    <div class="w-[76px] text-center">Details</div>
                    <div class="w-[76px] text-center">Service</div>
                    <div class="w-[76px] text-center">Confirm</div>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('appointment.submit') }}" id="bs-form">
                @csrf
                <input type="hidden" name="_booking" value="1">

                <div class="p-6 max-h-[55vh] overflow-y-auto">

                    <!-- Step 1: Personal Details -->
                    <div id="bs-step-1" class="space-y-4">
                        <p class="text-xs text-gray-500 mb-1">Your registered details — these are linked to your account.</p>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Full Name</label>
                            <input type="text" name="name" required value="{{ $bsUser->name ?? '' }}" readonly
                                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 bg-gray-50 text-gray-700 text-sm cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Email Address</label>
                            <input type="email" name="email" required value="{{ $bsUser->email ?? '' }}" readonly
                                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 bg-gray-50 text-gray-700 text-sm cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Phone Number</label>
                            <div class="flex gap-2">
                                <select name="country_code" required
                                        class="w-[100px] shrink-0 px-2 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm bg-white">
                                    <option value="+255" {{ old('country_code', '+255') == '+255' ? 'selected' : '' }}>🇹🇿 +255</option>
                                    <option value="+974" {{ old('country_code') == '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+254" {{ old('country_code') == '+254' ? 'selected' : '' }}>🇰🇪 +254</option>
                                    <option value="+256" {{ old('country_code') == '+256' ? 'selected' : '' }}>🇺🇬 +256</option>
                                    <option value="+27" {{ old('country_code') == '+27' ? 'selected' : '' }}>🇿🇦 +27</option>
                                    <option value="+971" {{ old('country_code') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+966" {{ old('country_code') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+91" {{ old('country_code') == '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                </select>
                                <input type="tel" name="phone" required value="{{ old('phone', $bsUser->phone ?? '') }}"
                                       placeholder="792 326 665"
                                       class="flex-1 px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                            </div>
                            <p id="bs-phone-error" class="text-xs text-red-500 mt-1 hidden"></p>
                        </div>

                        <div class="pt-4">
                            <button type="button" onclick="bsNextStep()" class="w-full bg-primary hover:bg-[#6a1b9a] text-white py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                                Next <i class="fas fa-arrow-right ml-1.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Service & Time -->
                    <div id="bs-step-2" class="space-y-4 hidden">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Service Type</label>
                            <select name="service_id" required onchange="bsUpdatePrice()" id="bs-service"
                                    class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                                <option value="">Select a service</option>
                                @foreach($bsServices as $s)
                                    <option value="{{ $s->id }}" data-price="{{ $s->price }}" data-currency="{{ $s->currency }}" data-duration="{{ $s->duration_minutes }}">
                                        {{ $s->name }} — {{ $s->formatted_price }} ({{ $s->duration_minutes }} min)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Preferred Date</label>
                                <input type="date" name="appointment_date" required min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}"
                                       class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Preferred Time</label>
                                <select name="appointment_time" required
                                        class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                                    <option value="">Select time</option>
                                    @foreach($bsTimeSlots as $slot)
                                        <option value="{{ substr($slot->start_time, 0, 5) }}">{{ $slot->start_formatted }} — {{ $slot->end_formatted }}</option>
                                    @endforeach
                                </select>
                                <p class="text-[10px] text-gray-400 mt-1">45-minute sessions</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Payment Method</label>
                            <select name="payment_method" required
                                    class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                                <option value="">Select payment method</option>
                                <option value="mpesa">M-Pesa</option>
                                <option value="airtel_money">Airtel Money</option>
                                <option value="card">Card (Credit/Debit)</option>
                                <option value="cash">Cash (Pay at session)</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <button type="button" onclick="bsPrevStep()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2.5 rounded-lg font-medium text-sm transition inline-flex items-center gap-1.5">
                                <i class="fas fa-arrow-left text-xs"></i> Back
                            </button>
                            <button type="button" onclick="bsNextStep()" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                                Next <i class="fas fa-arrow-right ml-1.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Confirm & Book -->
                    <div id="bs-step-3" class="space-y-4 hidden">
                        <div class="bg-gray-50 rounded-xl p-5 space-y-3 border border-primary/30">
                            <h4 class="text-sm font-bold text-dark flex items-center gap-2"><i class="fas fa-user text-primary text-xs"></i> Personal Details</h4>
                            <div class="text-sm space-y-1.5 text-gray-600" id="bs-confirm-details">
                                <p><span class="text-gray-400 w-20 inline-block">Name:</span> <span class="font-medium text-gray-800" id="bs-c-name">{{ $bsUser->name ?? '' }}</span></p>
                                <p><span class="text-gray-400 w-20 inline-block">Email:</span> <span class="font-medium text-gray-800" id="bs-c-email">{{ $bsUser->email ?? '' }}</span></p>
                                <p><span class="text-gray-400 w-20 inline-block">Phone:</span> <span class="font-medium text-gray-800" id="bs-c-phone">{{ $bsUser->phone ?? '' }}</span></p>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 space-y-3 border border-primary/30">
                            <h4 class="text-sm font-bold text-dark flex items-center gap-2"><i class="fas fa-tag text-primary text-xs"></i> Service & Time</h4>
                            <div class="text-sm space-y-1.5 text-gray-600" id="bs-confirm-service">
                                <p><span class="text-gray-400 w-24 inline-block">Service:</span> <span class="font-medium text-gray-800" id="bs-c-service"></span></p>
                                <p><span class="text-gray-400 w-24 inline-block">Date:</span> <span class="font-medium text-gray-800" id="bs-c-date"></span></p>
                                <p><span class="text-gray-400 w-24 inline-block">Time:</span> <span class="font-medium text-gray-800" id="bs-c-time"></span></p>
                                <p><span class="text-gray-400 w-24 inline-block">Fee:</span> <span class="font-bold text-primary" id="bs-c-fee"></span></p>
                                <p><span class="text-gray-400 w-24 inline-block">Pay via:</span> <span class="font-medium text-gray-800" id="bs-c-payment"></span></p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <button type="button" onclick="bsPrevStep()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2.5 rounded-lg font-medium text-sm transition inline-flex items-center gap-1.5">
                                <i class="fas fa-arrow-left text-xs"></i> Back
                            </button>
                            <button type="submit" id="bs-submit-btn" onclick="return bsConfirm(this)" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                                <i class="fas fa-calendar-check mr-1.5"></i> Confirm & Book
                            </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <!-- Empty Cart Modal -->
    <div id="emptyCartModal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center transform transition-all duration-300">
            <div class="w-20 h-20 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-shopping-bag text-3xl text-primary"></i>
            </div>
            <h2 class="text-xl font-bold text-dark mb-2">Your cart is empty</h2>
            <p class="text-sm text-gray-500 mb-8">Your cart is currently empty. Browse our books or book a session to get started.</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('books') }}" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-3 rounded-full font-semibold transition-all shadow-lg inline-flex items-center justify-center gap-2">
                    <i class="fas fa-book"></i> Browse Books
                </a>
                <a href="javascript:void(0)" onclick="document.getElementById('emptyCartModal').classList.add('hidden'); openBookModal()" class="bg-secondary hover:bg-yellow-400 text-dark px-6 py-3 rounded-full font-semibold transition-all shadow-md inline-flex items-center justify-center gap-2">
                    <i class="fas fa-calendar-check"></i> Book a Session
                </a>
                <button onclick="document.getElementById('emptyCartModal').classList.add('hidden')" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Go Back
                </button>
            </div>
        </div>
    </div>

    <script>
    function openCartOrModal() {
        fetch('/cart/count')
            .then(r => r.json())
            .then(data => {
                if (data.count > 0) {
                    window.location.href = '{{ route("cart.index") }}';
                } else {
                    document.getElementById('emptyCartModal').classList.remove('hidden');
                }
            });
    }

    function openBookModal() {
        @auth
            document.getElementById('bookModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            bsGoToStep(1);
        @else
            openAuthModal('login');
        @endauth
    }

    function closeBookModal() {
        document.getElementById('bookModal').classList.add('hidden');
        document.body.style.overflow = '';
        bsGoToStep(1);
    }

    function bsGoToStep(step) {
        bsCurrentStep = step;
        for (let i = 1; i <= bsTotalSteps; i++) {
            const circle = document.getElementById('bs-step' + i + '-circle');
            const content = document.getElementById('bs-step-' + i);
            const line = document.getElementById('bs-step' + i + '-line');

            if (i < step) {
                circle.className = 'w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-xs font-bold';
                circle.innerHTML = '<i class="fas fa-check text-[10px]"></i>';
                if (line) line.className = 'w-12 h-0.5 bg-green-500';
                content.classList.add('hidden');
            } else if (i === step) {
                circle.className = 'w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold';
                circle.textContent = i;
                if (line) line.className = 'w-12 h-0.5 bg-primary';
                content.classList.remove('hidden');
            } else {
                circle.className = 'w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-bold';
                circle.textContent = i;
                if (line) line.className = 'w-12 h-0.5 bg-gray-200';
                content.classList.add('hidden');
            }
        }

    }

    function bsNextStep() {
        const countryCode = document.querySelector('select[name="country_code"]');
        const phone = document.querySelector('input[name="phone"]');
        const phoneError = document.getElementById('bs-phone-error');
        const service = document.querySelector('select[name="service_id"]');
        const date = document.querySelector('input[name="appointment_date"]');
        const time = document.querySelector('select[name="appointment_time"]');
        const payment = document.querySelector('select[name="payment_method"]');

        if (bsCurrentStep === 1) {
            phoneError.classList.add('hidden');
            phone.classList.remove('border-red-500');
            const digitsOnly = phone.value.replace(/\D/g, '');
            if (!phone.value.trim()) {
                phone.classList.add('border-red-500');
                phoneError.textContent = 'Phone number is required';
                phoneError.classList.remove('hidden');
                phone.focus();
                return;
            }
            if (!/^[\d\s\+\-\(\)]+$/.test(phone.value.trim())) {
                phone.classList.add('border-red-500');
                phoneError.textContent = 'Only digits, spaces, +, -, ( ) allowed';
                phoneError.classList.remove('hidden');
                phone.focus();
                return;
            }
            if (digitsOnly.length < 6) {
                phone.classList.add('border-red-500');
                phoneError.textContent = 'Phone number must have at least 6 digits';
                phoneError.classList.remove('hidden');
                phone.focus();
                return;
            }
            if (digitsOnly.length > 9) {
                phone.classList.add('border-red-500');
                phoneError.textContent = 'Phone number must not exceed 9 digits after country code';
                phoneError.classList.remove('hidden');
                phone.focus();
                return;
            }
        }
        if (bsCurrentStep === 2) {
            let valid = true;
            if (!service.value) { service.classList.add('border-red-500'); valid = false; } else service.classList.remove('border-red-500');
            if (!date.value) { date.classList.add('border-red-500'); valid = false; } else date.classList.remove('border-red-500');
            if (!time.value) { time.classList.add('border-red-500'); valid = false; } else time.classList.remove('border-red-500');
            if (!payment.value) { payment.classList.add('border-red-500'); valid = false; } else payment.classList.remove('border-red-500');
            if (!valid) return;

            document.getElementById('bs-c-name').textContent = document.querySelector('#bs-form input[name="name"]').value;
            document.getElementById('bs-c-email').textContent = document.querySelector('#bs-form input[name="email"]').value;
            document.getElementById('bs-c-phone').textContent = countryCode.value + ' ' + phone.value;

            const sel = service.options[service.selectedIndex];
            document.getElementById('bs-c-service').textContent = sel.text;
            document.getElementById('bs-c-date').textContent = new Date(date.value + 'T00:00:00').toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
            document.getElementById('bs-c-time').textContent = time.options[time.selectedIndex].text;
            document.getElementById('bs-c-fee').textContent = sel.dataset.currency + ' ' + parseFloat(sel.dataset.price).toFixed(2);
            document.getElementById('bs-c-payment').textContent = payment.options[payment.selectedIndex].text;
        }
        if (bsCurrentStep < bsTotalSteps) bsGoToStep(bsCurrentStep + 1);
    }

    function bsPrevStep() {
        if (bsCurrentStep > 1) bsGoToStep(bsCurrentStep - 1);
    }

    function bsUpdatePrice() {
        const sel = document.getElementById('bs-service');
        const opt = sel.options[sel.selectedIndex];
        const display = document.getElementById('bs-price-display');
        const priceSpan = document.getElementById('bs-display-price');
        if (opt.value) {
            priceSpan.textContent = opt.dataset.currency + ' ' + parseFloat(opt.dataset.price).toFixed(2);
            display.classList.remove('hidden');
        } else {
            display.classList.add('hidden');
        }
    }

    let bsSubmitting = false;

    function bsConfirm(btn) {
        if (bsSubmitting) return false;
        bsSubmitting = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i> Booking...';
        btn.classList.add('opacity-60', 'cursor-not-allowed');
        return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('bs-service')?.value) bsUpdatePrice();
    });

    // Reopen modal on validation errors
    @if(session('open_booking_modal') || old('_booking'))
        window.addEventListener('DOMContentLoaded', () => openBookModal());
    @endif
    </script>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-28 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    <script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle', warning: 'fa-exclamation-triangle', info: 'fa-info-circle' };
        const colors = {
            success: 'bg-emerald-50 border-emerald-200 text-emerald-800',
            error: 'bg-red-50 border-red-200 text-red-800',
            warning: 'bg-amber-50 border-amber-200 text-amber-800',
            info: 'bg-blue-50 border-blue-200 text-blue-800'
        };
        const iconColors = { success: 'text-emerald-500', error: 'text-red-500', warning: 'text-amber-500', info: 'text-blue-500' };

        const toast = document.createElement('div');
        toast.className = `pointer-events-auto flex items-start gap-3.5 px-5 py-4 rounded-2xl border shadow-lg ${colors[type] || colors.success} translate-x-full opacity-0 transition-all duration-500 ease-out max-w-sm`;
        toast.style.transform = 'translateX(120%)';
        toast.innerHTML = `
            <i class="fas ${icons[type] || icons.success} text-lg mt-0.5 ${iconColors[type] || iconColors.success} shrink-0"></i>
            <p class="text-sm font-medium flex-1">${message}</p>
            <button onclick="this.closest('#toast-container > div').remove()" class="shrink-0 opacity-50 hover:opacity-100 transition">
                <i class="fas fa-times text-xs"></i>
            </button>
        `;

        container.appendChild(toast);

        requestAnimationFrame(() => {
            toast.style.transform = 'translateX(0)';
            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');
        });

        setTimeout(() => {
            toast.style.transform = 'translateX(120%)';
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('successModalMessage').textContent = '{{ session('success') }}';
            document.getElementById('successModal').classList.remove('hidden');
        });
    @endif
    @if(session('error'))
        document.addEventListener('DOMContentLoaded', () => showToast('{{ session('error') }}', 'error'));
    @endif
    @if(session('warning'))
        document.addEventListener('DOMContentLoaded', () => showToast('{{ session('warning') }}', 'warning'));
    @endif
    @if(session('info'))
        document.addEventListener('DOMContentLoaded', () => showToast('{{ session('info') }}', 'info'));
    @endif
    </script>

    @stack('scripts')

    <!-- Success Modal (for session flash messages) -->
    <div id="successModal" class="fixed inset-0 z-[9999] bg-black bg-opacity-60 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 text-center transform transition-all duration-300">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-2xl text-green-600"></i>
            </div>
            <h3 class="text-lg font-bold text-dark mb-2">Success</h3>
            <p id="successModalMessage" class="text-sm text-gray-600">Operation completed successfully.</p>
            <button onclick="document.getElementById('successModal').classList.add('hidden')" class="mt-6 bg-primary hover:bg-[#6a1b9a] text-white px-8 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                Done
            </button>
        </div>
    </div>
</body>
</html>
