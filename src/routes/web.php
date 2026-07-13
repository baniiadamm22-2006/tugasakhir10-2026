<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Livewire\EditMasterData;


/* NOTE: Do Not Remove */
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/* END */

// Definisi route yang rapi dan tidak duplikat
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/divisi/{id}', [EmployeeController::class, 'show'])->name('division.detail');

Route::get('/divisi/{id}', [App\Http\Controllers\DivisionController::class, 'show']);
Route::get('/complaint/{id}/detail', [ComplaintController::class, 'getDetail']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Tambahkan baris ini bersama route login lainnya
Route::get('/auth/google', [LoginController::class, 'googleLogin'])->name('login.google');
Route::get('/dashboard/download-pdf', [App\Http\Controllers\DashboardController::class, 'downloadLaporan'])->name('dashboard.pdf');




Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/dashboard/download-pdf', [DashboardController::class, 'downloadLaporan'])->name('dashboard.pdf');


Route::get('/pengaturan', function () {

    return view('pengaturan');

});