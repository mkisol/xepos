<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ProfileController,
    RoleAndPermissionController
};

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('dashboard'));
    Route::get('/dashboard', fn () => view('dashboard'));

    Route::get('/profile', ProfileController::class)->name('profile');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});

Route::resource('companies', App\Http\Controllers\CompanyController::class)->middleware('auth');
Route::resource('employees', App\Http\Controllers\EmployeeController::class)->middleware('auth');