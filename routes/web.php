<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
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
    Route::get('/admin', function () {
        return view ('admin.dashboard');
    });
});

Route::middleware(['auth', 'isDriver'])->group(function () {
    Route::get('/driver', function () {
        return view ('driver.dashboard');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
