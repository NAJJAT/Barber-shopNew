<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FAQAdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['guest'])->group(function () {

// Login Route
Route::get('/login', function () {
    return view('views.auth.login')->name('login');
});

// Register Route
Route::get('/register', function () {
    return view('views.auth.register')->name('register');
});

// Logout Route
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
});

// Guest routes

Route::get('/services', [ServiceController::class, 'indexuser'])->name('services.index');
Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');
Route::get('/faqs', [FAQController::class, 'publicIndex'])->name('faqs.public'); // Bekijk openbare FAQ's
Route::get('/faqs/{id}', [FAQController::class, 'getFAQsByCategory']);
Route::get('news', [NewsController::class, 'index'])->name('news.index');
//route conect
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');



// routes/web.php
Route::get('/about',function(){
    return view('about');
})->name('about');


});


Route::middleware('auth')->group(function () {
    Route::get('user/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('user/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/booking/{service}', [BookingController::class, 'create'])->name('booking.create');
    // Gebruiker kan eigen FAQ's beheren
    Route::get('/user/faqs', [FAQController::class, 'userIndex'])->name('user.faqs.index'); // Gebruikerseigen FAQ's
    Route::get('/user/faqs/create', [FAQController::class, 'create'])->name('user.faqs.create'); // Voeg een FAQ toe
    Route::post('/user/faqs', [FAQController::class, 'store'])->name('user.faqs.store'); // Opslaan FAQ
    Route::get('/user/faqs/{faq}/edit', [FAQController::class, 'edit'])->name('user.faqs.edit'); // Bewerken FAQ
    Route::put('/user/faqs/{faq}', [FAQController::class, 'update'])->name('user.faqs.update'); // Bijwerken FAQ
    Route::delete('/user/faqs/{faq}', [FAQController::class, 'destroy'])->name('user.faqs.destroy'); // Verwijderen FAQ
    Route::get('user/news', [NewsController::class, 'index'])->name('news.index');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/services', [ServiceController::class, 'indexuser'])->name('user.services.index'); // View services
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    //comments user/ Bookings/comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    //barbers for user 
    Route::get('/barbers/{barber}', [BarberController::class,'show'])->name('barbers.show');
    Route::get('/user/barbers/{barber}/bookings', [BarberController::class, 'bookings'])->name('barbers.bookings');
    Route::get('/user/barbers/{barber}/bookings/{booking}', [BarberController::class, 'bookingShow'])->name('barbers.booking.show');
    Route::get('/user/barbers/{barber}/bookings/{booking}/edit', [BarberController::class, 'bookingEdit'])->name('barbers.booking.edit');
    Route::put('/user/barbers/{barber}/bookings/{booking}', [BarberController::class, 'bookingUpdate'])->name('barbers.booking.update');

}); 

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Service routes
    Route::get('admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('admin/services', [ServiceController::class,'store'])->name('admin.services.store');
    Route::get('admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('admin/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('admin/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    Route::get('admin/services/{service}/delete', [ServiceController::class, 'delete'])->name('admin.services.delete');
    //admin routes for barbers
    Route::get('admin/barbers/', [BarberController::class, 'index'])->name('admin.barbers.index');
    Route::get('admin/barbers/create', [BarberController::class, 'create'])->name('admin.barbers.create');
    Route::post('admin/barbers', [BarberController::class,'store'])->name('admin.barbers.store');
    Route::get('admin/barbers/{barber}/edit', [BarberController::class, 'edit'])->name('admin.barbers.edit');
    Route::put('admin/barbers/{barber}', [BarberController::class, 'update'])->name('admin.barbers.update');
    Route::delete('admin/barbers/{barber}', [BarberController::class, 'destroy'])->name('admin.barbers.destroy');
    Route::get('admin/barbers/{barber}/delete', [BarberController::class, 'delete'])->name('admin.barbers.delete');
    // admin routes for bookings
    Route::get('admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('admin/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::post('admin/bookings', [BookingController::class, 'store'])->name('admin.bookings.store');
    Route::get('admin/bookings/create', [BookingController::class, 'create'])->name('admin.bookings.create');
    Route::get('admin/bookings/{booking}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::put('admin/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('admin/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('admin/bookings/{booking}/delete', [BookingController::class, 'delete'])->name('admin.bookings.delete');
    // FAQ routes
    Route::get('admin/faqs', [FAQController::class, 'adminIndex'])->name('admin.faqs.index'); // Beheer alle FAQ's
    Route::get('admin/faqs/create', [FAQController::class, 'create'])->name('admin.faqs.create'); // Voeg FAQ toe
    Route::post('admin/faqs', [FAQController::class, 'store'])->name('admin.faqs.store'); // Opslaan FAQ
    Route::get('admin/faqs/{faq}/edit', [FAQController::class, 'edit'])->name('admin.faqs.edit'); // Bewerken FAQ
    Route::put('admin/faqs/{faq}', [FAQController::class, 'update'])->name('admin.faqs.update'); // Bijwerken FAQ
    Route::delete('admin/faqs/{faq}', [FAQController::class, 'destroy'])->name('admin.faqs.destroy'); // Verwijderen FAQ
    //admin comments
    Route::get('/admin/comments', [CommentController::class, 'manageComments'])->name('admin.comments.index');
    Route::delete('admin/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
    Route::get('admin/comments/{comment}/edit', [CommentController::class, 'edit'])->name('admin.comments.edit');
    Route::put('admin/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
    Route::get('admin/comments/create', [CommentController::class, 'create'])->name('admin.comments.create');
    Route::post('admin/comments', [CommentController::class, 'store'])->name('admin.comments.store');
    // admin  promte users
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/admin/users/{user}/promote', [AdminUserController::class, 'promote'])->name('admin.users.promote');
    Route::post('admin/users/{user}/demote', [AdminUserController::class, 'demote'])->name('admin.users.demote');
    //admin news
    Route::get('admin/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
    Route::get('admin/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
    Route::post('admin/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::get('admin/news/{news}', [AdminNewsController::class, 'show'])->name('admin.news.show');
    Route::get('admin/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
    Route::delete('admin/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::put('admin/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');


});


require __DIR__.'/auth.php';

