<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\faq;
use App\Models\Location;
use App\Models\Items;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\AccountChartsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FinancesController;
use Illuminate\Support\Facades\Auth;

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
    return view('request')->with('input', $request)->with('locations', Location::all())->with('items', Items::all());;
});


Route::get('/solution', function () {
    return view('solution');
})->name('contact');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/app', function () {
    return view('layouts.app');
});

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('/activity_log', [DashboardController::class, 'activity'])->name('activity_log');

    //Locations
    Route::resource('locations', '\App\Http\Controllers\Admin\LocationController');
    Route::resource('items', '\App\Http\Controllers\Admin\ItemsController');

    //Vendors
    Route::resource('vendors', '\App\Http\Controllers\Admin\VendorController');

    //Accounts
    Route::resource('accounts', '\App\Http\Controllers\Admin\AccountChartsController');

    //Orders
    Route::resource('order', '\App\Http\Controllers\Admin\OrderController');
    Route::post('/order/{driver}/{order}', [OrderController::class, 'assign'])->name('order.assign');

    //vehicles
    Route::resource('vehicles', '\App\Http\Controllers\Admin\VehiclesController');

    //Finances
    Route::resource('finances', '\App\Http\Controllers\Admin\FinancesController');
    Route::get('/accountsList', [AjaxController::class, 'getAccounts']);


    //Drivers
    Route::prefix('drivers')->group(function(){
        Route::get('/', [DriverController::class, 'index'])->name('drivers');
        Route::get('/create', [DriverController::class, 'create'])->name('drivers.create');
        Route::post('/create', [DriverController::class, 'store'])->name('drivers.store');
        Route::get('/{id}', [DriverController::class, 'show'])->name('drivers.show');
        Route::put('/{id}', [DriverController::class, 'update'])->name('drivers.update');
    });

    //Clients
    Route::prefix('clients')->group(function(){
        Route::get('/', [ClientController::class, 'index'])->name('clients');
        Route::get('/{id}', [ClientController::class, 'show'])->name('clients.show');
        Route::put('/{id}', [ClientController::class, 'update'])->name('clients.update');
    });

    //FAQ
    Route::prefix('faqs')->group(function(){
        Route::get('/', [FaqController::class, 'index'])->name('faqs.index');
        Route::get('/{id}', [AjaxController::class, 'getFaq']);
        Route::post('/', [FaqController::class, 'store'])->name('faqs.store');
        Route::put('/{id}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/{id}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    });

    Route::resource('pricing', '\App\Http\Controllers\Admin\PricingController');

});

Route::middleware(['auth', 'isDriver'])->group(function () {
    Route::get('/driver', function () {
        return view ('driver.dashboard');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/location/{id}', [AjaxController::class, 'location']);
Route::get('/request', [BookRequestController::class, 'order'])->name('order');
Route::put('/request', [BookRequestController::class, 'storeOrder'])->name('request');

// Laravel 8
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('/send-mail', [EmailController::class, 'testMail'])->name('testMail');
