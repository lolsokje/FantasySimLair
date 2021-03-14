<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
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
