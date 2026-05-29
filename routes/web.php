<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientBookController;
use App\Http\Controllers\ClientAppointmentController;
use App\Http\Controllers\AdminController;

// Public Static Routes
Route::get('/', function () {
    $latestBook = \App\Models\Book::where('status', 'active')->latest()->first();
    return view('home', compact('latestBook'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

// Dynamic Public Bookstore Routes
Route::get('/books', [ClientBookController::class, 'index'])->name('books');
Route::post('/books/{book}/purchase', [ClientBookController::class, 'purchase'])->name('book.purchase');

// Blog Routes
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Contact Form Submission
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Public Appointments & Scheduling
Route::post('/appointment/submit', [ClientAppointmentController::class, 'submit'])->name('appointment.submit');

// Authenticated appointment status (client panel)
Route::middleware(['auth'])->group(function () {
    Route::get('/appointment-status', [ClientAppointmentController::class, 'showStatus'])->name('appointment.status');
});

// Cart & Checkout Routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{key}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{key}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'count'])->name('cart.count');

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/order/confirmation/{order}', [App\Http\Controllers\OrderController::class, 'confirmation'])->name('order.confirmation');

// Redirect guests to home with login modal (Laravel auth middleware uses 'login' named route)
Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

// Client Modal Authentication & Profile
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientProfileController;

Route::post('/login', [ClientAuthController::class, 'login'])->name('login.submit');
Route::post('/register', [ClientAuthController::class, 'register'])->name('register.submit');
Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ClientProfileController::class, 'index'])->name('profile');
    Route::get('/my-books', [ClientProfileController::class, 'myBooks'])->name('my-books');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/download/{orderItem}', [App\Http\Controllers\OrderController::class, 'download'])->name('order.download');
});

// Notifications API
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markRead'])->name('notifications.read');
});

// Authenticated Admin Dashboard Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Manage Appointments
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::put('/appointments/{appointment}', [AdminController::class, 'updateAppointment'])->name('admin.appointment.update');
    Route::delete('/appointments/{appointment}/delete', [AdminController::class, 'deleteAppointment'])->name('admin.appointment.delete');
    
    // Manage Bookstore Catalog
    Route::get('/books', [AdminController::class, 'books'])->name('admin.books');
    Route::post('/books/store', [AdminController::class, 'storeBook'])->name('admin.book.store');
    Route::put('/books/{book}', [AdminController::class, 'updateBook'])->name('admin.book.update');
    Route::delete('/books/{book}/delete', [AdminController::class, 'deleteBook'])->name('admin.book.delete');
    
    // Manage Pre-orders (Book Purchases)
    Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{purchase}', [App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.order.show');
    Route::put('/orders/{purchase}', [App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.order.update');
    Route::delete('/orders/{purchase}/delete', [App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('admin.order.destroy');

    // Manage Services & Time Slots
    Route::get('/services', [App\Http\Controllers\AdminServiceController::class, 'index'])->name('admin.services');
    Route::post('/services/store', [App\Http\Controllers\AdminServiceController::class, 'store'])->name('admin.service.store');
    Route::put('/services/{service}', [App\Http\Controllers\AdminServiceController::class, 'update'])->name('admin.service.update');
    Route::delete('/services/{service}/delete', [App\Http\Controllers\AdminServiceController::class, 'destroy'])->name('admin.service.delete');

    Route::get('/time-slots', [App\Http\Controllers\AdminTimeSlotController::class, 'index'])->name('admin.time-slots');
    Route::post('/time-slots/store', [App\Http\Controllers\AdminTimeSlotController::class, 'store'])->name('admin.time-slot.store');
    Route::put('/time-slots/{timeSlot}', [App\Http\Controllers\AdminTimeSlotController::class, 'update'])->name('admin.time-slot.update');
    Route::delete('/time-slots/{timeSlot}/delete', [App\Http\Controllers\AdminTimeSlotController::class, 'destroy'])->name('admin.time-slot.delete');

    // Manage Blog Posts
    Route::get('/posts', [App\Http\Controllers\AdminPostController::class, 'index'])->name('admin.posts');
    Route::post('/posts/store', [App\Http\Controllers\AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::put('/posts/{post}', [App\Http\Controllers\AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{post}/delete', [App\Http\Controllers\AdminPostController::class, 'destroy'])->name('admin.posts.delete');

    // Manage Consultation Client Directory
    Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients');
    Route::get('/clients/{user}', [AdminController::class, 'clientDetails'])->name('admin.client.details');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


