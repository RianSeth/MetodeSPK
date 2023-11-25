<?php

use App\Http\Controllers\AlternatifWPController;
use App\Http\Controllers\DataWPController;
use App\Http\Controllers\KriteriaWPController;
use App\Http\Controllers\MethodeTOPSISController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/wp/krwp', [DataWPController::class, 'krwp'])->name('krwp');
    Route::get('/wp/alwp', [DataWPController::class, 'alwp'])->name('alwp');
    Route::get('/wp/datawp', [DataWPController::class, 'datawp'])->name('datawp');
    Route::post('/wp/create/kriteria', [KriteriaWPController::class, 'create'])->name('kriteriawpcreate');
    Route::post('/wp/create/alternatif', [AlternatifWPController::class, 'create'])->name('alternatifwpcreate');
    Route::post('/wp/create/data', [DataWPController::class, 'create'])->name('datawpcreate');
    Route::post('/wp/destroy/data', [DataWPController::class, 'destroy'])->name('datadestroy');
    Route::get('/methodetopsis', [MethodeTOPSISController::class, 'methodetopsis'])->name('methodetopsis');
    Route::get('/hasil', [MethodeTOPSISController::class, 'hasil'])->name('hasiltopsis');
});

require __DIR__.'/auth.php';
