<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
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
    return view('guest.homepage');
});

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'PageController@dashboard')->name('dashboard');
        Route::resource('apartments', 'ApartmentController');
        Route::resource('messages', 'MessageController');
        Route::resource('services', 'ServiceController');
        Route::resource('views', 'ViewController');
        Route::resource('sponsorships', 'SponsorshipController');
        Route::get('/sponsorships/payment/{value}', 'SponsorshipController@payment')->name('sponsorships.show');
        Route::post('/checkout', 'SponsorshipController@checkout')->name('sponsorships.checkout');
});

Route::get('{any?}', function() {
    return view('guest.homepage');
})->where("any", ".*")->name('homepage');
