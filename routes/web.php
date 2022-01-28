<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\faq;
use App\Models\Location;
use App\Models\Items;
use App\Models\State;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\AccountChartsController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FinancesController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\VehiclesController;
use App\Http\Controllers\ClientOrderController;
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
    return view('welcome')->with('faqs', faq::all())->with('locations', Location::all())->with('states', State::orderBy('state')->get());
});

Route::post('/', function (Request $request) {
    return view('request')->with('input', $request)->with('locations', Location::all())->with('items', Items::all())->with('states', State::orderBy('state')->get());
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

Route::get('/chat', [ChatsController::class, 'index'])->middleware('auth');
Route::get('/messages/{id}', [ChatsController::class, 'fetchMessages'])->middleware('auth');
Route::post('/chat/message', [ChatsController::class, 'sendMessage'])->middleware('auth');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'store'])->name('profile.store');

    //Route::get('/chat', [ChatsController::class, 'index'])->name('chat.index');
    Route::get('/sendChat', [ChatsController::class, 'index'])->name('chat.index');
    Route::post('/sendChat', [ChatsController::class, 'sendMessage'])->name('chat.sendMessage');

    Route::get('/activity_log', [DashboardController::class, 'activity'])->name('activity_log');

    //Locations
    Route::resource('locations', '\App\Http\Controllers\Admin\LocationController');
    Route::resource('items', '\App\Http\Controllers\Admin\ItemsController');
    Route::resource('state', '\App\Http\Controllers\Admin\StateController');

    //Vendors
    Route::resource('vendors', '\App\Http\Controllers\Admin\VendorController');

    //Accounts
    Route::resource('accounts', '\App\Http\Controllers\Admin\AccountChartsController');

    //Orders
    Route::prefix('orders')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/create', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/{driver}/{order}', [OrderController::class, 'assign'])->name('orders.assign');
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });

    //vehicles
    Route::resource('vehicles', '\App\Http\Controllers\Admin\VehiclesController');
    Route::post('vehicles/{id}', [VehiclesController::class, 'storeMemo'])->name('vehicles.storeMemo');

    //Finances
    Route::resource('finances', '\App\Http\Controllers\Admin\FinancesController');
    Route::get('/accountsList', [AjaxController::class, 'getAccounts']);


    //Drivers
    Route::prefix('drivers')->group(function(){
        Route::get('/', [DriverController::class, 'index'])->name('drivers');
        Route::get('/create', [DriverController::class, 'create'])->name('drivers.create');
        Route::post('/create', [DriverController::class, 'store'])->name('drivers.store');
        Route::post('/{id}', [DriverController::class, 'storeMemo'])->name('drivers.storeMemo');
        Route::get('/{id}', [DriverController::class, 'show'])->name('drivers.show');
        Route::put('/{id}', [DriverController::class, 'update'])->name('drivers.update');
    });

    //Reports
    Route::prefix('reports')->group(function(){
        Route::get('/cash-flow', [ReportsController::class, 'cash_flow'])->name('reports.cash-flow');
        Route::get('/balance-sheet', [ReportsController::class, 'balance_sheet'])->name('reports.balance-sheet');
        Route::get('/profit-loss', [ReportsController::class, 'profit_loss'])->name('reports.profit-loss');
        Route::get('/sales-report', [ReportsController::class, 'sales_report'])->name('reports.sales-report');
        Route::get('/defaulters', [ReportsController::class, 'defaulters'])->name('reports.defaulters');
        Route::put('/{id}', [ReportsController::class, 'update'])->name('reports.update');
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
    Route::get('/driver', [App\Http\Controllers\Driver\DashboardController::class, 'dashboard'])->name('driver_dashboard');
    Route::get('/dashboard', [App\Http\Controllers\Driver\DashboardController::class, 'dashboard'])->name('driver_dashboard');
    Route::get('driver/profile', [App\Http\Controllers\Driver\ProfileController::class, 'index'])->name('driver_profile');
    Route::put('driver/profile/{id}', [App\Http\Controllers\Driver\ProfileController::class, 'store'])->name('driver_profile.store');
    Route::get('driver/activity_log', [App\Http\Controllers\Driver\DashboardController::class, 'activity'])->name('driver_activity_log');
    Route::resource('order', '\App\Http\Controllers\Driver\OrderController');
    Route::resource('report', '\App\Http\Controllers\Driver\ReportController');
    Route::resource('vehicle', '\App\Http\Controllers\Driver\VehiclesController');
    Route::post('vehicle/{id}', [App\Http\Controllers\Driver\VehiclesController::class, 'storeMemo'])->name('vehicle.storeMemo');
});

Route::middleware(['auth'])->prefix('client')->group(function () {
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('client-orders');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/location/{id}', [AjaxController::class, 'location']);
Route::get('/pstate/{id}', [AjaxController::class, 'state']);
Route::get('/dstate/{id}', [AjaxController::class, 'state']);
Route::get('/request', [BookRequestController::class, 'order'])->name('order');
Route::put('/request', [BookRequestController::class, 'storeOrder'])->name('request');

// Laravel 8
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');

Route::get('/send-mail', [EmailController::class, 'testMail'])->name('testMail');
