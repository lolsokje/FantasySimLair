<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SeasonController;
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

    Route::prefix('championships')->group(function () {
        Route::get('', [AdminController::class, 'championships'])->name('admin.championships');
        Route::get('create', [ChampionshipController::class, 'create'])->name('admin.championships.create');
        Route::get('{championship}/edit', [ChampionshipController::class, 'edit'])->name('admin.championships.edit');
        Route::post('store', [ChampionshipController::class, 'store'])->name('admin.championships.store');
        Route::patch('{championship}', [ChampionshipController::class, 'update'])->name('admin.championships.update');
    });

    Route::prefix('requests')->group(function () {
        Route::get('', [AdminController::class, 'requests'])->name('admin.requests');
        Route::patch('{championshipRequest}/approve', [RequestController::class, 'approve'])->name('admin.requests.approve');
        Route::patch('{championshipRequest}/reject', [RequestController::class, 'reject'])->name('admin.requests.reject');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('championships', [ChampionshipController::class, 'index'])->name('championships.index');
    Route::get('championships/{championship}', [ChampionshipController::class, 'show'])->name('championships.show');
    Route::get('championships/{championship}/edit', [ChampionshipController::class, 'edit'])->name('championships.edit');
    Route::patch('championships/{championship}', [ChampionshipController::class, 'update'])->name('championships.update');

    Route::get('championships/{championship}/season', [SeasonController::class, 'create'])->name('seasons.create');
    Route::get('seasons/{season}/edit', [SeasonController::class, 'edit'])->name('seasons.edit');
    Route::get('seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
    Route::patch('seasons/{season}', [SeasonController::class, 'update'])->name('seasons.update');
    Route::post('championships/{championship}/season', [SeasonController::class, 'store'])->name('seasons.store');

    Route::get('requests', [RequestController::class, 'create'])->name('requests.create');
    Route::post('requests', [Requestcontroller::class, 'store'])->name('requests.store');
});