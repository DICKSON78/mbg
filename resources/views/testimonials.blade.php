@extends('layouts.app')

@section('title', 'Client Testimonials | MBG Wellness')

@section('content')
    <!-- Testimonials Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Client <span class="text-gradient">Testimonials</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Hear from individuals and organizations who have experienced transformation through our services</p>
            </div>
        </div>
    </section>

    <!-- Featured Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">TRANSFORMATION STORIES</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Voices of <span class="text-primary">Healing</span></h2>
                <div class="w-24 h-1 bg-secondary mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md hover-scale">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic mb-6">"After just three months of therapy at MBG, my anxiety attacks reduced from daily to maybe once a month. Dr. Susan gave me practical tools that actually work in real life situations."</p>
                        <div class="flex items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                <i class="fas fa-user text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark">Sarah K.</h4>
                                <p class="text-gray-600">Anxiety Management Client</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md hover-scale">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic mb-6">"The marriage counseling saved our relationship. We learned communication skills that helped us understand each other rather than just argue. Two years later, we're happier than we've ever been."</p>
                        <div class="flex items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                <i class="fas fa-user-friends text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark">Michael & Grace</h4>
                                <p class="text-gray-600">Couples Therapy Clients</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Testimonial 3 -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md hover-scale">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic mb-6">"As a school administrator, I've seen firsthand how MBG's youth programs have helped our students. The self-esteem workshops particularly made a noticeable difference in our girls' confidence levels."</p>
                        <div class="flex items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                <i class="fas fa-user-graduate text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark">Mr. Joseph M.</h4>
                                <p class="text-gray-600">School Principal</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 4 -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md hover-scale">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic mb-6">"The grief counseling helped me navigate the loss of my mother in ways I didn't think possible. Dr. Susan's compassionate yet direct approach was exactly what I needed to process my emotions healthily."</p>
                        <div class="flex items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                <i class="fas fa-heart text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-dark">Amina S.</h4>
                                <p class="text-gray-600">Grief Counseling Client</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ route('contact') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl hover-scale inline-flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i> Book Your Session
                </a>
            </div>
        </div>
    </section>
@endsection
