<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [URLController::class, 'index']);
Route::post('/urls', [URLController::class, 'store']);
Route::get('/{shortCode}', [URLController::class, 'show'])->name('urls.show');
Route::post('/urls/track', [URLController::class, 'trackClick'])->name('urls.track');
// Route::get('/urls/{shortCode}/track', [URLController::class, 'trackClick']);
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


