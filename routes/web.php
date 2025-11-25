<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;

/*
|--------------------------------------------------------------------------
| Landing & Redirect Routes
|--------------------------------------------------------------------------
*/

// Halaman landing/welcome
Route::get('/', function () {
    return view('index');
})->name('landing');

// Redirect /app ke beranda
Route::get('/app', function () {
    return redirect()->route('beranda');
})->name('app');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

// Halaman beranda/dashboard
Route::get('/beranda', [TugasController::class, 'beranda'])->name('beranda');

/*
|--------------------------------------------------------------------------
| Tugas Routes
|--------------------------------------------------------------------------
*/

// Halaman tugas yang sudah selesai (custom route - HARUS DI ATAS resource!)
Route::get('/tugasSelesai', [TugasController::class, 'tugasSelesai'])->name('tugasSelesai');

// Resource route untuk CRUD tugas
// PENTING: Ini akan generate route dengan parameter {tugas}
Route::resource('tugas', TugasController::class);