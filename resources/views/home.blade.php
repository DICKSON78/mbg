@extends('layouts.app')

@section('title', 'Mind, Body & Goals | Premium Counseling & Wellness')

@section('content')
    <!-- Hero Section -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden hero-pattern">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-primary to-purple-900 opacity-95"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-12 lg:mb-0 animate__animated animate__fadeInLeft">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Transform Your <span class="text-gradient">Mind, Body & Soul</span></h1>
                    <p class="text-xl text-gray-200 mb-8 max-w-lg">Holistic counseling and wellness services designed to help you achieve emotional balance, mental clarity, and physical wellbeing.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl hover-scale">Get Started</a>
                        <a href="{{ route('services') }}" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all hover-scale">Our Services</a>
                    </div>
                </div>
                <div class="lg:w-1/2 flex justify-center animate__animated animate__fadeInRight">
                    <div class="relative">
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-white bg-opacity-20 absolute -top-6 -left-6"></div>
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-secondary bg-opacity-20 absolute -bottom-6 -right-6"></div>
                        <img src="{{ asset('assets/img/drsusan.JPG') }}" alt="Dr. Susan Bamidele" class="relative z-10 w-64 h-64 md:w-80 md:h-80 object-cover rounded-2xl shadow-2xl border-4 border-white hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold text-primary mb-2">10+</div>
                    <div class="text-gray-600">Years Experience</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-primary mb-2">500+</div>
                    <div class="text-gray-600">Clients Served</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-primary mb-2">95%</div>
                    <div class="text-gray-600">Client Satisfaction</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold text-primary mb-2">100+</div>
                    <div class="text-gray-600">Workshops Conducted</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-2/5 mb-12 lg:mb-0 lg:pr-12">
                    <div class="relative">
                        <img src="{{ asset('assets/img/book.jpeg') }}" alt="My Identity: Becoming Who I Say I Am" class="rounded-2xl shadow-2xl w-full max-w-md mx-auto hover:scale-105 transition-transform duration-500">
                        <div class="absolute -bottom-6 -right-6 bg-primary text-white p-4 rounded-2xl shadow-lg w-3/4">
                            <div class="text-center">
                                <h4 class="font-bold text-lg">Available Now</h4>
                                <p class="text-sm opacity-90">Get Your Copy Today</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-3/5">
                    <span class="text-primary font-semibold">NEW BOOK RELEASE</span>
                    <h2 class="text-4xl font-bold text-dark mb-6 mt-2">My Identity: <span class="text-primary">Becoming Who I Say I Am</span></h2>
                    <p class="text-xl text-gray-700 mb-6 italic">"What would happen if you stopped letting the world define you and started defining yourself?"</p>
                    
                    <div class="bg-gray-50 p-6 rounded-2xl mb-8 border-l-4 border-secondary">
                        <p class="text-lg text-gray-700 leading-relaxed">
                            In <span class="font-semibold text-primary">My Identity: Becoming Who I Say I Am</span>, Dr. Susan O. Bamidele weaves psychology, storytelling, and faith into a transformative guide on self-worth, healing, and inner peace. Through the journey of Akello, a woman who learns to peel away false labels and embrace her true identity, this book explores the power of words, the science of self-talk, and the beauty of becoming who you were always meant to be.
                        </p>
                    </div>
                    
                    <p class="text-lg text-gray-700 mb-8 font-medium">
                        It's not just a story. It's an invitation, to speak life, rewrite your narrative, and find serenity in your identity.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('books') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl hover-scale flex items-center">
                            <i class="fas fa-book mr-2"></i> Get Your Copy
                        </a>
                        <a href="{{ route('books') }}" class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-semibold transition-all hover-scale">
                            Learn More About the Book
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Preview -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12">
                    <span class="text-primary font-semibold">ABOUT DR. SUSAN</span>
                    <h2 class="text-4xl font-bold text-dark mb-6 mt-2">Expert Care With <span class="text-primary">Compassion</span></h2>
                    <p class="text-lg text-gray-700 mb-6">Dr. Susan O. Bamidele is a PhD-level counseling psychologist with over a decade of experience helping individuals and families navigate life's challenges and achieve holistic wellness.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>PhD in Counseling Psychology</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Certified Christian Counselor</span>
                        </li>
                        
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Published Author & Speaker</span>
                        </li>
                         <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Member of American Psychological Association (APA)</span>
                        </li>
                         <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Licensed minister of the Gospel (Dominion clergy council worldwide) DCCW</span>
                        </li>
                    </ul>
                    <a href="{{ route('about') }}" class="inline-flex items-center text-primary font-semibold hover:text-secondary transition group">
                        Learn More About Dr. Susan
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="{{ asset('assets/img/drsusan.JPG') }}" alt="Dr. Susan working with client" class="rounded-2xl shadow-xl w-full">
                        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-100 w-3/4">
                            <div class="flex items-center">
                                <div class="bg-primary text-white p-3 rounded-full mr-4">
                                    <i class="fas fa-award text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-dark">Award Winning</h4>
                                    <p class="text-gray-600">Recognized for excellence in counseling</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Image moved to left side -->
                <div class="lg:w-1/2 lg:order-first mb-12 lg:mb-0">
                    <div class="relative">
                        <img src="{{ asset('assets/img/olu-profile.JPG') }}" alt="Olu teaching wellness techniques" class="rounded-2xl shadow-xl w-full">
                        <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-100 w-3/4">
                            <div class="flex items-center">
                                <div class="bg-primary text-white p-3 rounded-full mr-4">
                                    <i class="fas fa-star text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-dark">Proven Success</h4>
                                    <p class="text-gray-600">Transforming lives since 2007</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content moved to right side -->
                <div class="lg:w-1/2 lg:pl-12">
                    <span class="text-primary font-semibold">ABOUT OLU</span>
                    <h2 class="text-4xl font-bold text-dark mb-6 mt-2">Holistic Wellness Through <span class="text-primary">Mind & Body</span></h2>
                    <p class="text-lg text-gray-700 mb-6">Olu is a former Bank Manager and Financial Expert who transitioned into health and fitness, launching Mind Body and Goals in 2004 to help people transform their lives through comprehensive wellness approaches.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Economics Degree from University of Kent</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Certified Personal Trainer (ISSA)</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>UK Level 4 Advanced Diploma in Sports Nutrition</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-2"></i>
                            <span>Certified NLP Practitioner</span>
                        </li>
                    </ul>
                    <a href="{{ route('about') }}" class="inline-flex items-center text-primary font-semibold hover:text-secondary transition group">
                        Learn More About Olu's Approach
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">OUR SERVICES</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Holistic <span class="text-primary">Wellness Solutions</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Comprehensive care tailored to your unique needs</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-couch"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Counseling & Therapy</h3>
                        <p class="text-gray-600 mb-6">Individual, couples, and family therapy for emotional healing and stronger relationships.</p>
                        <a href="{{ route('services') }}#counseling" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Wellness Coaching</h3>
                        <p class="text-gray-600 mb-6">Personalized plans for mental, physical, and spiritual wellbeing.</p>
                        <a href="{{ route('services') }}#wellness" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Corporate Programs</h3>
                        <p class="text-gray-600 mb-6">Workplace wellness initiatives and mental health training.</p>
                        <a href="{{ route('services') }}#corporate" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('services') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center">
                    <i class="fas fa-list-ul mr-2"></i> View All Services
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Preview -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">CLIENT STORIES</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Transformations <span class="text-primary">We've Facilitated</span></h2>
                <div class="w-24 h-1 bg-secondary mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card p-8 rounded-xl shadow-md hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"Coming to MBG changed my life. I found a place, clarity and tools to cope with my anxiety."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">A.M.</h4>
                            <p class="text-gray-600">Dodoma</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-md hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"Dr. Susan's approach helped me rebuild my marriage when we were on the verge of divorce."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-user-friends text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">J. & M. Family</h4>
                            <p class="text-gray-600">Doha</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-md hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"The corporate wellness program transformed our workplace culture. Productivity increased by 40%."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">Tech Solutions Ltd.</h4>
                            <p class="text-gray-600">Tanzania</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('testimonials') }}" class="inline-flex items-center text-primary font-semibold hover:text-secondary transition group">
                    Read More Success Stories
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary text-white relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Begin Your <span class="text-secondary">Wellness Journey?</span></h2>
                <p class="text-xl mb-8">Take the first step towards a healthier, happier you. Book your session today and experience transformative care.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/255792326665" target="_blank" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl hover-scale flex items-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i> WhatsApp Booking
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white hover:bg-opacity-90 text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl hover-scale">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
