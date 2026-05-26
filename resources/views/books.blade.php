@extends('layouts.app')

@section('title', 'Our Publications | MBG Wellness')

@section('content')
    <!-- Books Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-28 relative overflow-hidden bg-primary">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Our <span class="text-gradient">Publications</span></h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Transformative books that guide you on your journey to mental, emotional, and spiritual wellness</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#store" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Browse Bookstore</a>
                    <a href="#reviews" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all">Read Reviews</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Purchase Status Alerts -->
    @if (session('purchase_success'))
        <section class="py-6 bg-green-50 border-b border-green-100">
            <div class="container mx-auto px-6">
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 max-w-3xl mx-auto">
                    <div class="flex items-start">
                        <div class="bg-green-100 text-green-600 p-2 rounded-full mr-4">
                            <i class="fas fa-check text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ session('purchase_success') }}</h3>
                            <div class="text-gray-600 text-sm whitespace-pre-line leading-relaxed">
                                {!! session('payment_instructions') !!}
                            </div>
                            <p class="text-xs text-gray-400 mt-4">An order invoice confirmation has been sent to your email. Please contact our support team on WhatsApp if you require immediate help.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Promotional / Advertised Books Showcase -->
    @if ($advertisedBooks->isNotEmpty())
        @foreach ($advertisedBooks as $adBook)
            <section id="featured-{{ $adBook->id }}" class="py-20 bg-white border-b border-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <span class="text-primary font-semibold">FEATURED ADVERTISEMENT</span>
                        <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Special <span class="text-primary">Release</span></h2>
                        <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
                    </div>
                    
                    <div class="flex flex-col lg:flex-row items-center gap-12">
                        <div class="lg:w-2/5">
                            <div class="relative">
                                @if ($adBook->cover_image)
                                    <img src="{{ asset($adBook->cover_image) }}" alt="{{ $adBook->title }}" class="rounded-2xl shadow-2xl w-full max-w-md mx-auto book-cover border border-gray-100">
                                @else
                                    <div class="w-full max-w-md mx-auto aspect-[3/4] bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 border border-gray-200 shadow-xl">
                                        <i class="fas fa-book-open text-6xl"></i>
                                    </div>
                                @endif
                                <div class="absolute -bottom-6 -right-6 bg-primary text-white p-4 rounded-2xl shadow-lg w-3/4">
                                    <div class="text-center">
                                        <h4 class="font-bold text-lg">Featured Release</h4>
                                        <p class="text-sm opacity-90">{{ $adBook->currency }} {{ number_format($adBook->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lg:w-3/5">
                            <span class="text-primary font-semibold">PROMOTED PUBLICATION</span>
                            <h2 class="text-4xl font-bold text-dark mb-6 mt-2">{{ $adBook->title }}</h2>
                            <p class="text-sm text-gray-500 mb-2">Written by {{ $adBook->author }}</p>
                            
                            <div class="bg-gray-50 p-6 rounded-2xl mb-8 border-l-4 border-secondary">
                                <p class="text-lg text-gray-700 leading-relaxed whitespace-pre-line">{{ $adBook->description }}</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-4">
                                <form method="POST" action="{{ route('cart.add') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="type" value="book">
                                    <input type="hidden" name="item_id" value="{{ $adBook->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" 
                                            class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl hover-scale flex items-center"
                                            onclick="this.disabled=true;this.closest('form').submit();">
                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                    </button>
                                </form>
                                <button onclick='openPurchaseModal({!! json_encode($adBook) !!})' 
                                        class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-semibold transition-all hover-scale flex items-center">
                                    <i class="fas fa-bolt mr-2"></i> Quick Buy
                                </button>
                                @if ($adBook->purchase_url)
                                    <a href="{{ $adBook->purchase_url }}" target="_blank" class="border-2 border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-dark px-8 py-3 rounded-full font-semibold transition-all hover-scale flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> View on Amazon
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        <!-- Fallback to original static flagship publication if database is empty -->
        <section id="featured" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-primary font-semibold">OUR FLAGSHIP PUBLICATION</span>
                    <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Transformative <span class="text-primary">Reading</span></h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover the power of self-definition and inner transformation</p>
                    <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
                </div>
                
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-2/5">
                        <div class="relative">
                            <img src="{{ asset('assets/img/book.jpeg') }}" alt="My Identity: Becoming Who I Say I Am" class="rounded-2xl shadow-2xl w-full max-w-md mx-auto book-cover">
                            <div class="absolute -bottom-6 -right-6 bg-primary text-white p-4 rounded-2xl shadow-lg w-3/4">
                                <div class="text-center">
                                    <h4 class="font-bold text-lg">New Release</h4>
                                    <p class="text-sm opacity-90">Available Now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:w-3/5">
                        <span class="text-primary font-semibold">FLAGSHIP BOOK</span>
                        <h2 class="text-4xl font-bold text-dark mb-6 mt-2">My Identity: <span class="text-primary">Becoming Who I Say I Am</span></h2>
                        <p class="text-xl text-gray-700 mb-6 italic">"What would happen if you stopped letting the world define you and started defining yourself?"</p>
                        
                        <div class="bg-gray-50 p-6 rounded-2xl mb-8 border-l-4 border-secondary">
                            <p class="text-lg text-gray-700 leading-relaxed">
                                In <span class="font-semibold text-primary">My Identity: Becoming Who I Say I Am</span>, Dr. Susan O. Bamidele weaves psychology, storytelling, and faith into a transformative guide on self-worth, healing, and inner peace. Through the journey of Akello, a woman who learns to peel away false labels and embrace her true identity, this book explores the power of words, the science of self-talk, and the beauty of becoming who you were always meant to be.
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-4">
                            <form method="POST" action="{{ route('cart.add') }}" class="inline">
                                @csrf
                                <input type="hidden" name="type" value="book">
                                <input type="hidden" name="item_id" value="1">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="bg-primary hover:bg-opacity-90 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg hover:shadow-xl hover-scale flex items-center">
                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                </button>
                            </form>
                            <a href="https://wa.me/255792326665?text=Hi!%20I%20would%20like%20to%20purchase%20'My%20Identity:%20Becoming%20Who%20I%20Say%20I%20Am'%20book" target="_blank" class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-full font-semibold transition-all hover-scale flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i> Order via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Dynamic Bookstore Catalog -->
    <section id="store" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">ONLINE STORE</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Our <span class="text-primary">Bookstore Catalog</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore all available books and publications from Dr. Susan O. Bamidele</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>

            @if ($catalogBooks->isEmpty())
                <div class="text-center py-16 text-gray-400 bg-white rounded-2xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
                    <i class="fas fa-book-open text-5xl mb-4 text-primary opacity-50"></i>
                    <p class="text-lg font-semibold text-gray-700">Bookstore Catalog is Empty</p>
                    <p class="text-sm text-gray-500 mt-1">Please check back later or contact us directly for publication updates.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogBooks as $book)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col justify-between hover-scale">
                            <div class="p-6">
                                <!-- Image cover -->
                                <div class="aspect-[3/4] bg-gray-50 rounded-xl overflow-hidden mb-6 relative border border-gray-100 shadow-inner">
                                    @if ($book->cover_image)
                                        <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="fas fa-book text-6xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">Book Release</span>
                                <h3 class="text-xl font-bold text-dark mt-1 mb-2">{{ $book->title }}</h3>
                                <p class="text-xs text-gray-500 mb-4">By {{ $book->author }}</p>
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">{{ $book->description }}</p>
                            </div>
                            
                            <!-- Bottom Footer -->
                            <div class="px-6 pb-6 pt-4 border-t border-gray-50 flex items-center justify-between">
                                <span class="text-lg font-bold text-[#842988]">{{ $book->currency }} {{ number_format($book->price, 2) }}</span>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="type" value="book">
                                        <input type="hidden" name="item_id" value="{{ $book->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" 
                                                class="bg-primary hover:bg-[#6a1b9a] text-white px-4 py-2 rounded-full font-semibold text-sm transition-all shadow-md flex items-center"
                                                onclick="this.disabled=true;this.closest('form').submit();">
                                            <i class="fas fa-cart-plus mr-1.5"></i> Add to Cart
                                        </button>
                                    </form>
                                    <button onclick='openPurchaseModal({!! json_encode($book) !!})' 
                                            class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-3 py-2 rounded-full font-semibold text-sm transition-all">
                                        <i class="fas fa-bolt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Book Reviews (Static) -->
    <section id="reviews" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">READER FEEDBACK</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">What Readers <span class="text-primary">Are Saying</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover how our publications are transforming lives</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card p-8 rounded-xl shadow-md bg-gray-50 hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"My Identity changed how I see myself. For the first time, I understand the power of my own words and thoughts in shaping my reality. This book is life-changing!"</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">Grace M.</h4>
                            <p class="text-gray-600">Reader from Kenya</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-md bg-gray-50 hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"The combination of psychology and faith in this book was exactly what I needed. It helped me process childhood trauma I'd carried for decades."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">David T.</h4>
                            <p class="text-gray-600">Reader from Tanzania</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-md bg-gray-50 hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"As a counselor, I recommend this book to my clients. The practical exercises and relatable stories make complex concepts accessible and actionable."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                            <i class="fas fa-user-md text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark">Professional Counselor</h4>
                            <p class="text-gray-600">Mental Health Practitioner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Purchase Modal -->
    <div id="purchaseModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-6 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transition-all">
            <!-- Modal Header -->
            <div class="bg-primary text-white p-6 flex justify-between items-center">
                <h3 class="font-bold text-lg flex items-center">
                    <i class="fas fa-shopping-bag mr-2"></i> Book Checkout Order
                </h3>
                <button onclick="closePurchaseModal()" class="text-white hover:text-gray-200 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="purchaseForm" method="POST" class="p-6 space-y-5">
                @csrf
                
                <!-- Book Brief Info -->
                <div class="flex items-center bg-gray-50 p-4 rounded-xl border border-gray-150">
                    <div class="h-16 w-12 bg-white rounded shadow-sm overflow-hidden shrink-0 border border-gray-200" id="modal_book_cover_container">
                        <img src="" id="modal_book_cover" class="h-full w-full object-cover">
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-dark" id="modal_book_title">Book Title</h4>
                        <p class="text-xs text-gray-500" id="modal_book_author">By Author</p>
                        <p class="text-sm font-bold text-primary mt-1" id="modal_book_price">Price</p>
                    </div>
                </div>

                <div>
                    <label for="buyer_name" class="block text-sm font-semibold text-gray-700 mb-1">Your Full Name*</label>
                    <input type="text" id="buyer_name" name="buyer_name" required 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="buyer_email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address*</label>
                        <input type="email" id="buyer_email" name="buyer_email" required 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                    <div>
                        <label for="buyer_phone" class="block text-sm font-semibold text-gray-700 mb-1">Phone Number (M-Pesa/Airtel)*</label>
                        <input type="tel" id="buyer_phone" name="buyer_phone" required placeholder="e.g. +255 792 326 665"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-1">Select Payment Gateway*</label>
                    <select id="payment_method" name="payment_method" required 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                        <option value="mpesa">M-Pesa Mobile Money (Tanzania)</option>
                        <option value="airtel_money">Airtel Money (Tanzania)</option>
                        <option value="tigo_pesa">Tigo Pesa (Tanzania)</option>
                        <option value="card">International Debit/Credit Card</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closePurchaseModal()" class="px-5 py-2.5 rounded-lg border border-gray-300 hover:bg-gray-50 font-semibold text-sm transition text-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary hover:bg-[#6a1b9a] text-white font-semibold text-sm transition shadow-md">
                        Submit Order & Pay
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const pModal = document.getElementById('purchaseModal');
        const pForm = document.getElementById('purchaseForm');
        const pCover = document.getElementById('modal_book_cover');
        const pCoverContainer = document.getElementById('modal_book_cover_container');
        const pTitle = document.getElementById('modal_book_title');
        const pAuthor = document.getElementById('modal_book_author');
        const pPrice = document.getElementById('modal_book_price');

        function openPurchaseModal(book) {
            pForm.action = `/books/${book.id}/purchase`;
            
            pTitle.textContent = book.title;
            pAuthor.textContent = "By " + book.author;
            
            // Format price
            const formattedPrice = book.currency + " " + parseFloat(book.price).toFixed(2);
            pPrice.textContent = formattedPrice;

            if (book.cover_image) {
                pCover.src = '/' + book.cover_image;
                pCoverContainer.style.display = 'block';
            } else {
                pCoverContainer.style.display = 'none';
            }

            pModal.classList.remove('hidden');
        }

        function closePurchaseModal() {
            pModal.classList.add('hidden');
        }
    </script>
@endsection
