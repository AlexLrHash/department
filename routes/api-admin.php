<?php

use Illuminate\Support\Facades\Route;

#TODO сделать для админа guard
Route::get('/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'admin'])->name('admin.user');

Route::get('/users', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getUsers'])->name('admin.users');
Route::get('/disciplines/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getDisciplines'])->name('admin.disciplines');
Route::get('/departments/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getDepartments'])->name('admin.departments');
