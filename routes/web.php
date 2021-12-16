<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\faq;
use App\Models\Location;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AjaxController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome')->with('faqs', faq::all())->with('locations', Location::all());
});

Route::post('/', function (Request $request) {
    return view('request')->with('input', $request)->with('locations', Location::all());
});


Route::get('/solution', function () {
    return view('solution');
});

Route::get('/testimonial', function () {
    return view('testimonial');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/app', function () {
    return view('layouts.app');
});

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'store'])->name('profile.store');

    //Locations
    Route::resource('locations', '\App\Http\Controllers\Admin\LocationController');
    
    //Orders
    Route::resource('booking', '\App\Http\Controllers\Admin\OrderController');
    
    //Pricing
    Route::resource('pricing', '\App\Http\Controllers\Admin\PricingController');

});

Route::middleware(['auth', 'isDriver'])->group(function () {
    Route::get('/driver', function () {
        return view ('driver.dashboard');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/location/{id}', [AjaxController::class, 'location']);
Route::get('/request', [HomeController::class, 'order'])->name('order');
Route::put('/request', [HomeController::class, 'storeOrder'])->name('request');

// Laravel 8
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
