<?php

use Illuminate\Support\Facades\Route;
use Modules\Clients\App\Http\Controllers\ClientsController;

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

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientsController::class, 'create'])->name('clients.create');
    Route::post('/store', [ClientsController::class, 'store'])->name('clients.store');
});

