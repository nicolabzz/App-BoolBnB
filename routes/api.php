<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apartments', 'Api\ApartmentController@index')->name('apartment.index');
Route::get('/apartments/random', 'Api\ApartmentController@random')->name('apartments.random');
Route::get('/apartments/{apartment}', 'Api\ApartmentController@show')->name('apartment.show');


Route::get('sponsorships', 'Api\Sponsorships\SponsorshipController@index');
Route::get('orders/generate', 'Api\Orders\OrderController@generate');
Route::post('orders/make/payment', 'Api\Orders\OrderController@makePayment');


