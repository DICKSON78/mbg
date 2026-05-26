@extends('layouts.app')

@section('title', 'About Our Team | MBG Wellness')

@section('content')
    <!-- About Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">About <span class="text-gradient">Our Team</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Meet the experts behind Mind, Body & Goals Wellness</p>
            </div>
        </div>
    </section>

    <!-- Dr. Susan Bio Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/3 mb-12 lg:mb-0 lg:pr-12">
                    <div class="relative group">
                        <img src="{{ asset('assets/img/drsusan.JPG') }}" alt="Dr. Susan O. Bamidele" class="rounded-2xl shadow-xl w-full h-auto group-hover:opacity-90 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-20 rounded-2xl transition-opacity duration-300"></div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold text-dark mb-4">Credentials</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>PhD in Counseling Psychology</span>
                            </li>
                             <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Masters in Theology</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Licensed Therapist</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Certified Christian counselor</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Published Author</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="lg:w-2/3">
                    <h2 class="text-4xl font-bold text-dark mb-6">Meet <span class="text-primary">Dr. Susan O. Bamidele</span></h2>
                    <p class="text-lg text-gray-700 mb-6">Dr. Susan O. Bamidele is a highly respected counselling psychologist, minister of the Gospel, and passionate advocate for emotional healing, spiritual growth, and holistic wellness. With a PhD in psychology and over a decade of experience, she blends professional expertise with deep spiritual insights to help individuals and communities overcome life's most difficult seasons.</p>
                    
                    <div class="prose max-w-none text-gray-700 mb-8">
                        <p>Born and raised in Kenya, Dr. Susan's multicultural background informs her culturally sensitive approach to therapy. Her journey in psychology began with a desire to understand human behavior and help people heal from emotional wounds.</p>
                        
                        <p class="border-l-4 border-primary pl-4 italic my-6 text-gray-600">"My mission is to provide a safe space where individuals can find healing, discover their purpose, and develop tools for lasting emotional wellbeing."</p>
                        
                        <p>In addition to her private practice, Dr. Susan is the founder of Woman of Purpose International (WOPI) and co-leads Soul to Soul Organisation, initiatives focused on empowering women and fostering spiritual growth.</p>
                    </div>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('services') }}" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl">Our Services</a>
                        <a href="{{ route('contact') }}" class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-semibold transition-all">Contact Dr. Susan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Olu Bio Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-2/3 lg:pr-12">
                    <h2 class="text-4xl font-bold text-dark mb-6">Meet <span class="text-primary">Olu</span>, Founder of Mind Body and Goals</h2>
                    <p class="text-lg text-gray-700 mb-6">After graduating from the University of Kent in Canterbury with a degree in Economics, Olu worked as a Bank Manager, Financial Adviser, Area Sales Manager and International Wealth Manager before transitioning into health and fitness in 2007. He launched Mind Body and Goals in April 2014 with a mission to build a global health and wellness business that transforms lives.</p>
                    
                    <div class="prose max-w-none text-gray-700 mb-8">
                        <p>Olu brings a unique combination of financial expertise and wellness knowledge to his practice. His diverse professional background gives him special insight into the stress-related health challenges faced by professionals and executives.</p>
                        
                        <p class="border-l-4 border-primary pl-4 italic my-6 text-gray-600">"My goal is to help people achieve complete wellness - not just physical fitness, but financial health and mental wellbeing too. True success comes when mind, body and goals are all aligned."</p>
                        
                        <p>With strong Christian beliefs as his foundation, Olu approaches wellness with drive, determination and a "never say die" attitude that inspires his clients. His qualifications span both business management and fitness, including a UK Level 4 Advanced Diploma in Sports Nutrition from the International Sports Science Association.</p>
                    </div>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="https://mbg.qa" target="_blank" class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl">Visit Our Fitness Programs at Qatar</a>
                    </div>
                </div>
                <div class="lg:w-1/3 mt-12 lg:mt-0">
                    <div class="relative group">
                        <img src="{{ asset('assets/img/olu-profile.JPG') }}" alt="Olu - Mind Body and Goals Founder" class="rounded-2xl shadow-xl w-full h-auto group-hover:opacity-90 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-20 rounded-2xl transition-opacity duration-300"></div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold text-dark mb-4">Credentials</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Economics Degree (University of Kent)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Certified Personal Trainer (ISSA)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>UK Level 4 Sports Nutrition Diploma</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Certified NLP Practitioner</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                                <span>Former Bank & Wealth Manager</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Approach Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">OUR APPROACH</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">The <span class="text-primary">MBG Method</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Blending professional expertise with compassionate care</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md hover-scale">
                    <div class="text-primary mb-4 text-4xl">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-dark mb-3">Evidence-Based</h3>
                    <p class="text-gray-600">Using proven therapeutic techniques grounded in psychological research and best practices.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md hover-scale">
                    <div class="text-primary mb-4 text-4xl">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-dark mb-3">Holistic</h3>
                    <p class="text-gray-600">Addressing mind, body, and spirit for comprehensive healing and growth.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md hover-scale">
                    <div class="text-primary mb-4 text-4xl">
                        <i class="fas fa-globe-africa"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-dark mb-3">Culturally Sensitive</h3>
                    <p class="text-gray-600">Respecting diverse backgrounds and incorporating cultural values in therapy.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Organizations Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">BEYOND THERAPY</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Community <span class="text-primary">Initiatives</span></h2>
                <div class="w-24 h-1 bg-secondary mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-xl hover-scale">
                    <h3 class="text-2xl font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-female text-primary mr-3"></i>
                        Woman of Purpose International (WOPI)
                    </h3>
                    <p class="text-gray-700 mb-4">Founded by Dr. Susan, WOPI is a faith-based mentorship organization dedicated to empowering women to discover their God-given purpose and potential.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Annual women's conferences</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Leadership development programs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Community outreach initiatives</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-xl hover-scale">
                    <h3 class="text-2xl font-semibold text-dark mb-4 flex items-center">
                        <i class="fas fa-hands-helping text-primary mr-3"></i>
                        Soul to Soul Organisation
                    </h3>
                    <p class="text-gray-700 mb-4">Co-led by Dr. Susan, this organization focuses on spiritual growth and emotional healing through retreats, counseling, and community programs.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Spiritual retreats and workshops</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Marriage enrichment programs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-2"></i>
                            <span>Youth mentorship initiatives</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Begin Your <span class="text-secondary">Wellness Journey?</span></h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Take the first step toward holistic health and personal growth today.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Book a Session</a>
                <a href="{{ route('services') }}" class="bg-white hover:bg-opacity-90 text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Our Services</a>
            </div>
        </div>
    </section>
@endsection
