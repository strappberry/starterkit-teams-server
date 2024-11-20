<?php

use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\TeamsController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'teams',
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('dashboard/settings')
        ->middleware(['module:configuracion'])
        ->as('dashboard.settings.')
        ->controller(SettingsController::class)
        ->group(function () {
            Route::middleware('permission:ver configuracion')->get('/', 'index')->name('index');
            Route::middleware('permission:editar configuracion')
                ->get('/subscription/{slug}', 'redirecToSubscription')->name('redirect-to-subscribe');
            Route::middleware('permission:editar configuracion')
                ->get('/manage-subscription', 'redirectToBilling')->name('redirectToBilling');
        });

    Route::prefix('dashboard/teams')
        ->middleware(['module:equipos'])
        ->as('dashboard.teams.')
        ->controller(TeamsController::class)
        ->group(function () {
            Route::middleware('permission:ver equipos')->get('/', 'index')->name('index');
            Route::middleware('permission:crear equipos')->get('create', 'create')->name('create');
            Route::middleware('permission:editar equipos')->get('{team}/edit', 'edit')->name('edit');
        });

    Route::prefix('dashboard/users')
        ->middleware(['module:usuarios'])
        ->as('dashboard.users.')
        ->controller(UsersController::class)
        ->group(function () {
            Route::middleware('permission:ver usuarios')->get('/', 'index')->name('index');
            Route::middleware('permission:crear usuarios')->get('create', 'create')->name('create');
            Route::middleware('permission:editar usuarios')->get('{user}/edit', 'edit')->name('edit');
        });
});
