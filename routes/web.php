<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtpController;
use App\Http\Middleware\CheckRole;

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
    return view('auth.login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    Route::middleware([CheckRole::class])->group(function(){
        Route::get('/dashboard', function() {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/crud', [KtpController::class, 'index'])->name('crud');
    Route::post('/filterktp', [KtpController::class, 'filter'])->name('filterktp');
    Route::post('/storektp', [KtpController::class, 'store'])->name('storektp');
    Route::post('/updatektp/{id}', [KtpController::class, 'update']);
    Route::post('/deletektp/{id}', [KtpController::class, 'destroy']);
    Route::post('/changeprov', [KtpController::class, 'changeprov'])->name('changeprov');
 
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
