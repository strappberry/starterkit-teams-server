<?php

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

    Route::prefix('dashboard/users')
        ->as('dashboard.users.')
        ->controller(UsersController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('{user}/edit', 'edit')->name('edit');
        });
});
