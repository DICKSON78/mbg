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
                    <a href="#publications" class="bg-secondary hover:bg-yellow-400 text-dark px-8 py-3 rounded-full text-lg font-semibold transition-all shadow-lg hover:shadow-xl">Browse Publications</a>
                    <a href="#reviews" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-full text-lg font-semibold transition-all">Read Reviews</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pre-order Status Alert -->
    @if (session('preorder_success'))
        <section class="py-6 bg-green-50 border-b border-green-100">
            <div class="container mx-auto px-6">
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 max-w-3xl mx-auto">
                    <div class="flex items-start">
                        <div class="bg-green-100 text-green-600 p-2 rounded-full mr-4">
                            <i class="fas fa-check text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg mb-1">{{ session('preorder_success') }}</h3>
                            <div class="text-gray-600 text-sm leading-relaxed">
                                {!! session('preorder_message') !!}
                            </div>
                            <p class="text-xs text-gray-400 mt-4">You can also reach us directly on WhatsApp for faster response.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Publication Catalog -->
    <section id="publications" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold">OUR PUBLICATIONS</span>
                <h2 class="text-4xl font-bold text-dark mb-4 mt-2">Our <span class="text-primary">Publications</span></h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore all available books and publications from Dr. Susan O. Bamidele</p>
                <div class="w-24 h-1 bg-secondary mx-auto mt-4"></div>
            </div>

            @if ($catalogBooks->isEmpty())
                <div class="text-center py-16 text-gray-400 bg-white rounded-2xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
                    <i class="fas fa-book-open text-5xl mb-4 text-primary opacity-50"></i>
                    <p class="text-lg font-semibold text-gray-700">No Publications Yet</p>
                    <p class="text-sm text-gray-500 mt-1">Please check back later or contact us directly for publication updates.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($catalogBooks as $book)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col justify-between hover-scale">
                            <div class="p-6">
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

                            <div class="px-6 pb-6 pt-4 border-t border-gray-50 flex items-center justify-between">
                                <span class="text-lg font-bold text-[#842988]">{{ $book->currency }} {{ number_format($book->price, 2) }}</span>
                                <button onclick='openPreorderModal({!! json_encode($book) !!})'
                                        class="bg-primary hover:bg-[#6a1b9a] text-white px-4 py-2 rounded-full font-semibold text-sm transition-all shadow-md flex items-center">
                                    <i class="fas fa-cart-plus mr-1.5"></i> Pre-order
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $catalogBooks->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Book Reviews -->
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
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"My Identity changed how I see myself. For the first time, I understand the power of my own words and thoughts in shaping my reality. This book is life-changing!"</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4"><i class="fas fa-user text-xl"></i></div>
                        <div><h4 class="font-semibold text-dark">Grace M.</h4><p class="text-gray-600">Reader from Kenya</p></div>
                    </div>
                </div>

                <div class="testimonial-card p-8 rounded-xl shadow-md bg-gray-50 hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"The combination of psychology and faith in this book was exactly what I needed. It helped me process childhood trauma I'd carried for decades."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4"><i class="fas fa-user text-xl"></i></div>
                        <div><h4 class="font-semibold text-dark">David T.</h4><p class="text-gray-600">Reader from Tanzania</p></div>
                    </div>
                </div>

                <div class="testimonial-card p-8 rounded-xl shadow-md bg-gray-50 hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"As a counselor, I recommend this book to my clients. The practical exercises and relatable stories make complex concepts accessible and actionable."</p>
                    <div class="flex items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4"><i class="fas fa-user-md text-xl"></i></div>
                        <div><h4 class="font-semibold text-dark">Professional Counselor</h4><p class="text-gray-600">Mental Health Practitioner</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pre-order Modal -->
    <div id="preorderModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-60 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transition-all duration-300">

            <!-- Form State -->
            <div id="preorderFormState">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-dark flex items-center gap-2"><i class="fas fa-cart-plus text-primary"></i> Pre-order Book</h3>
                    <button onclick="closePreorderModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times"></i></button>
                </div>

                <form id="preorderForm" method="POST" class="p-6 space-y-4" onsubmit="return submitPreorder(this, event)">
                    @csrf

                    <div class="bg-gray-50 rounded-xl p-5 border border-primary/30">
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-12 bg-white rounded-lg shadow-sm overflow-hidden shrink-0 border border-gray-200" id="modal_book_cover_container">
                                <img src="" id="modal_book_cover" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-dark" id="modal_book_title">Book Title</h4>
                                <p class="text-xs text-gray-500" id="modal_book_author">By Author</p>
                                <p class="text-sm font-bold text-primary mt-1" id="modal_book_price">Price</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="buyer_name" class="block text-xs font-semibold text-gray-600 mb-1">Your Full Name*</label>
                            <input type="text" id="buyer_name" name="buyer_name" required
                                   class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                        </div>
                        <div>
                            <label for="buyer_email" class="block text-xs font-semibold text-gray-600 mb-1">Email Address*</label>
                            <input type="email" id="buyer_email" name="buyer_email" required
                                   class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Phone Number*</label>
                        <div class="flex gap-2">
                            <select name="country_code" required
                                    class="w-[100px] shrink-0 px-2 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm bg-white">
                                <option value="+255">🇹🇿 +255</option>
                                <option value="+974">🇶🇦 +974</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+254">🇰🇪 +254</option>
                                <option value="+256">🇺🇬 +256</option>
                                <option value="+27">🇿🇦 +27</option>
                                <option value="+971">🇦🇪 +971</option>
                                <option value="+966">🇸🇦 +966</option>
                                <option value="+91">🇮🇳 +91</option>
                            </select>
                            <input type="tel" id="buyer_phone" name="buyer_phone" required placeholder="792 326 665"
                                   class="flex-1 px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="buyer_address" class="block text-xs font-semibold text-gray-600 mb-1">Delivery Address</label>
                        <textarea id="buyer_address" name="buyer_address" rows="2" placeholder="Street, city, country (for physical delivery)"
                                  class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm"></textarea>
                    </div>

                    <div>
                        <label for="buyer_notes" class="block text-xs font-semibold text-gray-600 mb-1">Additional Notes</label>
                        <textarea id="buyer_notes" name="buyer_notes" rows="2" placeholder="Any special requests or questions..."
                                  class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none text-sm"></textarea>
                    </div>

                    <div id="preorderError" class="hidden bg-red-50 border border-red-200 rounded-lg p-3 text-xs text-red-700"></div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closePreorderModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium text-sm transition">
                            Cancel
                        </button>
                        <button type="submit" id="preorderSubmitBtn" class="bg-primary hover:bg-[#6a1b9a] text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition shadow-md inline-flex items-center gap-1.5">
                            <i class="fas fa-paper-plane"></i> Submit Pre-order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Success State -->
            <div id="preorderSuccessState" class="hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-dark flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Pre-order Submitted</h3>
                    <button onclick="closePreorderModal()" class="text-gray-400 hover:text-gray-600 transition"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-8 text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                        <i class="fas fa-check text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-2" id="preorderSuccessName">Thank you!</h3>
                    <div class="text-sm text-gray-600 leading-relaxed max-w-sm mx-auto">
                        After submitting, our team will contact you to arrange <strong>delivery</strong> and <strong>manual payment</strong>.
                    </div>
                    <button onclick="closePreorderModal()" class="mt-8 bg-primary hover:bg-[#6a1b9a] text-white px-8 py-2.5 rounded-lg font-semibold text-sm transition shadow-md">
                        Done
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const pModal = document.getElementById('preorderModal');
        const pForm = document.getElementById('preorderForm');
        const pCover = document.getElementById('modal_book_cover');
        const pCoverContainer = document.getElementById('modal_book_cover_container');
        const pTitle = document.getElementById('modal_book_title');
        const pAuthor = document.getElementById('modal_book_author');
        const pPrice = document.getElementById('modal_book_price');
        const pFormState = document.getElementById('preorderFormState');
        const pSuccessState = document.getElementById('preorderSuccessState');
        const pSuccessName = document.getElementById('preorderSuccessName');
        const pError = document.getElementById('preorderError');
        const pSubmitBtn = document.getElementById('preorderSubmitBtn');

        function openPreorderModal(book) {
            pFormState.classList.remove('hidden');
            pSuccessState.classList.add('hidden');
            pError.classList.add('hidden');
            pForm.action = `/books/${book.id}/purchase`;

            pTitle.textContent = book.title;
            pAuthor.textContent = "By " + book.author;

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

        function closePreorderModal() {
            pModal.classList.add('hidden');
            pForm.reset();
            pFormState.classList.remove('hidden');
            pSuccessState.classList.add('hidden');
            pError.classList.add('hidden');
        }

        function submitPreorder(form, event) {
            event.preventDefault();
            pError.classList.add('hidden');
            pSubmitBtn.disabled = true;
            pSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            pSubmitBtn.classList.add('opacity-60', 'cursor-not-allowed');

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(r => {
                if (!r.ok) return r.json().then(err => Promise.reject(err));
                return r.json();
            })
            .then(data => {
                pSuccessName.textContent = 'Thank you, ' + data.name + '!';
                pFormState.classList.add('hidden');
                pSuccessState.classList.remove('hidden');
            })
            .catch(err => {
                const msg = err?.errors ? Object.values(err.errors).flat().join(', ') : (err?.message || 'Something went wrong. Please try again.');
                pError.textContent = msg;
                pError.classList.remove('hidden');
                pSubmitBtn.disabled = false;
                pSubmitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Pre-order';
                pSubmitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
            });

            return false;
        }
    </script>
@endpush
