<?php

use App\Http\Controllers\DataruangController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\inventory1controller;
use App\Http\Controllers\InventoryController;
use App\Http\Livewire\DataRuang;
use App\Http\Livewire\SuplierList;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('login');
});

// Auth::routes();
Auth::routes([
    'register' => false
]);

Route::middleware(['auth', 'checkStatus'])->group(function (){
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::get('/edit-profile', [App\Http\Controllers\EditProfileController::class, 'index']);
    Route::get('/edit-password', [App\Http\Controllers\ChangePasswordController::class, 'index']);
    Route::get('/delete', [App\Http\Controllers\InventoryController::class, 'destroyer']);
    Route::resource('/data-ruang', DataruangController::class);
    Route::get('/tambah-ruang', [App\Http\Controllers\CreateController::class, 'index']);
    Route::resource('inventory', InventoryController::class);

});

Route::middleware(['auth', 'rolePermision', 'checkStatus'])->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/incoming', [App\Http\Controllers\IncomingController::class, 'index']);
});


