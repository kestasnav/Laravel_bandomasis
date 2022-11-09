<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UzsakymaiController;
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

Route::middleware('auth')->group(function () {

Route::get('/',[HotelController::class, 'index'])->name('home');

Route::resource('hotels', HotelController::class);
Route::resource('countries', CountryController::class);
Route::resource('orders', UzsakymaiController::class);

Route::get('patvirtinimas',[UzsakymaiController::class, 'adminindex'])->name('adminindex');

Route::get('/image/{name}',[HotelController::class, 'display'])
    ->name('images');

Route::put('pateikti/{add}', [HotelController::class, 'pateiktiUzsakyma'])->name('pateikti');

Route::put('atsaukti/{add}', [HotelController::class, 'atsauktiUzsakyma'])->name('atsaukti');

Route::put('rate/{id}', [HotelController::class, 'rateHotels'])->name('ivertinti');

Route::post('posts/search',[HotelController::class, 'findPost'])->name('find.post');

Route::post('hotels/filter',[HotelController::class, 'filterHotels'])->name('hotels.filter');

Route::get('hotels/order/{field}',[HotelController::class,'orderPrice'])->name('price.order');

});

Auth::routes();
