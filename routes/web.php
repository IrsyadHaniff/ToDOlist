<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;


Route::get('/', function () {
    return view('index');
});
Route::get('/app', function () {
    return redirect()->route('beranda');
})->name('app');

Route::get('/beranda', function () {
    return view('beranda.index');
})->name('beranda');

Route::get('/listTugas', [TugasController::class, 'index'])->name('listTugas');
Route::patch('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
Route::resource('tugas', TugasController::class);

Route::get('/tugasSelesai', [TugasController::class, 'tugasSelesai'])->name('tugasSelesai');