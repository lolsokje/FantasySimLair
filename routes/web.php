<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/auth/discord/redirect', [AuthController::class, 'redirectToProvider'])->name('discord.redirect');

Route::get('/auth/discord/callback', [AuthController::class, 'handleProviderCallback'])->name('discord.callback');

Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
    Route::prefix('users')->group(function () {
        Route::get('', [AdminController::class, 'users'])->name('admin.users');
        Route::get('create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('', [UserController::class, 'store'])->name('admin.user.store');
    });

    Route::prefix('channels')->group(function () {
        Route::get('', [AdminController::class, 'channels'])->name('admin.channels');
        Route::get('create', [ChannelController::class, 'create'])->name('admin.channels.create');
        Route::post('store', [ChannelController::class, 'store'])->name('admin.channels.store');
        Route::delete('{channel}', [ChannelController::class, 'destroy'])->name('admin.channels.destroy');
    });


    Route::get('championships', [AdminController::class, 'championships'])->name('admin.championships');
});