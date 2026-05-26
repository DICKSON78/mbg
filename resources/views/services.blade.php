@extends('layouts.app')

@section('title', 'Our Services | MBG Wellness')

@section('content')
    <!-- Services Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Our <span class="text-gradient">Wellness Services</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Comprehensive care tailored to your unique needs and goals</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#counseling" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Counseling Services</a>
                    <a href="#wellness" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all">Wellness Programs</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Counseling Services -->
    <section id="counseling" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">HEALING & GROWTH</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Counseling <span class="text-primary">& Therapy</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Professional support for emotional healing and personal development</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Individual Therapy</h3>
                        <p class="text-gray-600 mb-4">One-on-one sessions for adults, youth (10+), and seniors addressing:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Anxiety & depression</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Trauma & PTSD</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Life transitions</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Book Session →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Couples Counseling</h3>
                        <p class="text-gray-600 mb-4">Strengthen your relationship through:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Conflict resolution</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Communication skills</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Intimacy building</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Book Session →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Family Therapy</h3>
                        <p class="text-gray-600 mb-4">Improve family dynamics with:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Parent-child relationships</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Blended family adjustment</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Intergenerational healing</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Book Session →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wellness Programs -->
    <section id="wellness" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">HOLISTIC HEALTH</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Wellness <span class="text-primary">Programs</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Comprehensive approaches to mental and physical wellbeing</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-brain"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Stress Management</h3>
                        <p class="text-gray-600 mb-4">Learn techniques to reduce stress and increase resilience:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Mindfulness practices</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Breathing techniques</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Lifestyle adjustments</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Nutritional Wellness</h3>
                        <p class="text-gray-600 mb-4">Explore the connection between diet and mental health:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Mood-boosting foods</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Gut-brain connection</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Healthy eating habits</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
                
                <div class="service-card bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <div class="service-icon text-white text-6xl">
                            <i class="fas fa-spa"></i>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-dark mb-4">Spiritual Growth</h3>
                        <p class="text-gray-600 mb-4">Faith-based counseling and guidance:</p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Finding purpose</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Overcoming spiritual doubts</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Biblical counseling</span>
                            </li>
                        </ul>
                        <a href="{{ route('contact') }}" class="text-primary font-medium hover:text-secondary transition">Learn More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Corporate Programs -->
    <section id="corporate" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">FOR ORGANIZATIONS</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Corporate <span class="text-primary">Wellness</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Enhance workplace wellbeing and productivity</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold text-dark mb-6">Customized Workplace Programs</h3>
                    <p class="text-gray-700 mb-6">We partner with organizations to create mentally healthy workplaces through tailored programs that address:</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start p-4 rounded-xl hover:bg-gray-50 transition">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-dark mb-2">Mental Health Workshops</h4>
                                <p class="text-gray-600">Interactive sessions on stress management, emotional intelligence, and work-life balance.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 rounded-xl hover:bg-gray-50 transition">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-user-shield text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-dark mb-2">Leadership Training</h4>
                                <p class="text-gray-600">Developing emotionally intelligent leaders who foster healthy work environments.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 rounded-xl hover:bg-gray-50 transition">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-lg mr-4">
                                <i class="fas fa-hands-helping text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-dark mb-2">Team Building</h4>
                                <p class="text-gray-600">Activities designed to improve communication, trust, and collaboration.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md">
                        <h3 class="text-2xl font-semibold text-dark mb-6">Benefits for Your Organization</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="bg-primary text-white p-2 rounded-full mr-4">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-gray-700">Reduced absenteeism and presenteeism</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-primary text-white p-2 rounded-full mr-4">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-gray-700">Increased employee engagement and satisfaction</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-primary text-white p-2 rounded-full mr-4">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-gray-700">Enhanced team cohesion and communication</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-primary text-white p-2 rounded-full mr-4">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-gray-700">Improved productivity and performance</span>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-primary text-white p-2 rounded-full mr-4">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <span class="text-gray-700">Stronger company culture and reputation</span>
                            </li>
                        </ul>
                        
                        <div class="mt-8">
                            <a href="{{ route('contact') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl w-full block text-center">
                                Request Corporate Proposal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Not Sure Which Service <span class="text-secondary">You Need?</span></h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">We'll help match you with the right program during your free 15-minute consultation.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Get a Consultation</a>
                <a href="tel:+255792326665" class="bg-white hover:bg-opacity-90 text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Call Now</a>
            </div>
        </div>
    </section>
@endsection
