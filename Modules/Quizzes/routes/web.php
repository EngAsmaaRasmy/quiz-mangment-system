<?php

use App\Filament\Resources\MemberResource\Pages\MemberDashboard;
use App\Filament\Resources\MemberResource\Pages\SolveQuiz;
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

Route::middleware(['auth'])->group(function () {
    // Route::get('/solve-quiz/{quiz}', SolveQuiz::class)->name('member.solve-quiz');
    Route::post('/submit-quiz/{quiz}', [SolveQuiz::class, 'submit'])->name('member.submit-quiz');
});