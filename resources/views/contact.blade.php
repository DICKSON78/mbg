@extends('layouts.app')

@section('title', 'Contact Us | MBG Wellness')

@section('content')
    <!-- Contact Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Contact <span class="text-gradient">MBG Wellness</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Reach out to begin your journey toward healing and growth</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact-form" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12">
                    <h2 class="text-3xl font-semibold text-dark mb-6">Get in Touch</h2>
                    <p class="text-gray-600 mb-8">We're here to answer your questions and help you take the first step toward wellness. Fill out the form or use the contact information below.</p>
                    
                    <div class="space-y-6 mb-8">
                        <div class="flex items-start">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark mb-1">Locations</h4>
                                <p class="text-gray-600">Dodoma, Tanzania</p>
                                <p class="text-gray-600">Unit U2, Building No. 138, Umm Al Roos Street, Zone 66, Dafna Area, Doha, Qatar</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark mb-1">Email</h4>
                                <p class="text-gray-600">info@mindbodygoals.com</p>
                                <p class="text-gray-600">olu@mbg.qa</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark mb-1">Phone/WhatsApp</h4>
                                <p class="text-gray-600">+255 792 326 665 (Tanzania)</p>
                                <p class="text-gray-600">+974 5579 1039 (Qatar)</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark mb-1">Hours</h4>
                                <p class="text-gray-600">Monday - Friday: 9am - 6pm</p>
                                <p class="text-gray-600">Saturday: 10am - 3pm</p>
                                <p class="text-gray-600">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-dark mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-primary w-12 h-12 rounded-full flex items-center justify-center text-xl transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-primary w-12 h-12 rounded-full flex items-center justify-center text-xl transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-primary w-12 h-12 rounded-full flex items-center justify-center text-xl transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="lg:w-1/2">
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md">
                        <h3 class="text-2xl font-semibold text-dark mb-6">Send Us a Message</h3>
                        
                        @if (session('error') || $errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                                {{ session('error') ?? 'Please correct the errors in the form.' }}
                                @if ($errors->any())
                                    <ul class="list-disc list-inside mt-2 text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('contact.submit') }}#contact-form">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-gray-700 mb-2">Name*</label>
                                    <input type="text" id="name" name="name" required 
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                           value="{{ old('name') }}">
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 mb-2">Email*</label>
                                    <input type="email" id="email" name="email" required 
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                           value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="phone" class="block text-gray-700 mb-2">Phone</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                       value="{{ old('phone') }}">
                            </div>
                            <div class="mb-6">
                                <label for="service" class="block text-gray-700 mb-2">Service Interested In</label>
                                <select id="service" name="service" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Select a service</option>
                                    <option value="individual" {{ old('service') == 'individual' ? 'selected' : '' }}>Individual Therapy</option>
                                    <option value="couples" {{ old('service') == 'couples' ? 'selected' : '' }}>Couples Counseling</option>
                                    <option value="family" {{ old('service') == 'family' ? 'selected' : '' }}>Family Therapy</option>
                                    <option value="corporate" {{ old('service') == 'corporate' ? 'selected' : '' }}>Corporate Programs</option>
                                    <option value="other" {{ old('service') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 mb-2">Message*</label>
                                <textarea id="message" name="message" rows="5" required 
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary hover:bg-opacity-90 text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Calendar Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-primary font-semibold">BOOK AN APPOINTMENT</span>
                <h2 class="text-3xl font-bold text-dark mb-4 mt-2">Schedule Your <span class="text-primary">Session</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Select an available time that works for you</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <iframe 
                    src="https://calendar.app.google/cZgDSsjN7ZHYuPNZ6" 
                    width="100%" 
                    height="800" 
                    frameborder="0" 
                    style="border:0; min-height: 800px;"
                    allowfullscreen>
                </iframe>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-6">Can't find a suitable time? <a href="#contact-form" class="text-primary hover:underline">Contact us directly</a> for alternative arrangements.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:+255792326665" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-phone-alt mr-2"></i> Call to Book
                    </a>
                    <a href="https://wa.me/255792326665" target="_blank" class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-semibold transition-all">
                        <i class="fab fa-whatsapp mr-2"></i> WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Map -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-primary font-semibold">OUR LOCATIONS</span>
                <h2 class="text-3xl font-bold text-dark mb-4 mt-2">Find Us in <span class="text-primary">Dodoma & Qatar</span></h2>
                <div class="w-24 h-1 bg-secondary mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover-scale">
                    <h3 class="text-xl font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i> 
                        Dodoma Office
                    </h3>
                    <p class="text-gray-600 mb-4">Area C<br>Dodoma, Tanzania</p>
                    <div class="h-64 rounded-lg overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.3602359831661!2d35.743331888701434!3d-6.16817339845477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x184de56160d64f13%3A0xb4ef6c0aea59a66a!2sArea%20C%2C%20Dodoma!5e0!3m2!1ssw!2stz!4v1755240735729!5m2!1ssw!2stz" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md hover-scale">
                    <h3 class="text-xl font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i> 
                        Qatar Office
                    </h3>
                    <p class="text-gray-600 mb-4">Unit U2, Building No. 138, Umm Al Roos Street, Zone 66, Dafna Area<br> Doha, Qatar</p>
                    <div class="h-64 rounded-lg overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.1522474289873!2d51.56191958703057!3d25.231796572784322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e45cefcfd817fcd%3A0x318b2b95f9e89d9b!2summ%20al%20roos%20street%2C%20Doha%2C%20Qatar!5e0!3m2!1sen!2stz!4v1755501147907!5m2!1sen!2stz"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">NEED HELP?</span>
                <h2 class="text-3xl font-bold text-dark mb-4 mt-2">Contact <span class="text-primary">FAQs</span></h2>
                <div class="w-24 h-1 bg-secondary mx-auto"></div>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden mb-6 hover-scale">
                    <button class="faq-question w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <h3 class="text-lg font-semibold text-dark">How soon can I get an appointment?</h3>
                        <i class="fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6 hidden">
                        <p class="text-gray-600">We typically can schedule new clients within 1-2 weeks. For urgent cases, we maintain a limited number of same-week appointments - please indicate if you need urgent care in your message.</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden mb-6 hover-scale">
                    <button class="faq-question w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <h3 class="text-lg font-semibold text-dark">What are your payment options?</h3>
                        <i class="fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6 hidden">
                        <p class="text-gray-600">We accept mobile payments (M-Pesa, Airtel Money , Mixx by Yas), credit cards, bank transfers, and cash. Payment is due at time of service unless other arrangements have been made with our office.</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden mb-6 hover-scale">
                    <button class="faq-question w-full flex justify-between items-center p-6 text-left focus:outline-none">
                        <h3 class="text-lg font-semibold text-dark">Do you offer sliding scale fees?</h3>
                        <i class="fas fa-chevron-down text-primary transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 pb-6 hidden">
                        <p class="text-gray-600">Yes, we offer a limited number of reduced-fee slots based on financial need. Please inquire about availability when scheduling your appointment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
