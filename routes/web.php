<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HotelController;
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

Route::get('/',[HotelController::class, 'index'])->name('home');

Route::resource('hotels', HotelController::class);
Route::resource('countries', CountryController::class);

Auth::routes();

Route::get('/image/{name}',[HotelController::class, 'display'])
    ->name('images');

Route::put('pateikti/{add}', [HotelController::class, 'pateiktiUzsakyma'])->name('pateikti');

Route::post('posts/search',[HotelController::class, 'findPost'])->name('find.post');

Route::post('hotels/filter',[HotelController::class, 'filterHotels'])->name('hotels.filter');

Route::get('hotels/order/{field}',[HotelController::class,'orderPrice'])->name('price.order');

