<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' =>'admin', 'as' =>'admin.'], function(){
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function(){
        Route::get('logout', [AdminController::class, 'logout']);
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('admin-password-edit', [AdminController::class, 'editAdminPassword'])->name('edit-admin-password');
        Route::post('admin-password-update', [AdminController::class, 'updateAdminPassword'])->name('update-admin-password');
        Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword'])->name('check-admin-pass');
        Route::get('admin-details/edit', [AdminController::class, 'editAdminDetails'])->name('edit-admin-details');
        Route::post('admin-details/update', [AdminController::class, 'updateAdminDetails'])->name('update-admin-details');
        Route::match(['get', 'post'], 'vendor-details/update/{slug}', [AdminController::class, 'updateVendorDetails']);
    });
});
