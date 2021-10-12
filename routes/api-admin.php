<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'admin'])->name('admin.user');

// users
Route::get('/users', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getUsers'])->name('admin.users');
Route::get('/users/{id}', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getUser'])->name('admin.user');

// teachers
Route::post('/teachers/{teacherSecondId}/disciplines/{disciplineSecondId}/add', [\App\Http\Controllers\Api\Admin\AdminController::class, 'addDiscipline']);
Route::post('/teachers/{teacherSecondId}/disciplines/{disciplineSecondId}/remove', [\App\Http\Controllers\Api\Admin\AdminController::class, 'removeDiscipline']);

// disciplines
Route::get('/disciplines/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getDisciplines'])->name('admin.disciplines');
Route::post('/disciplines/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'createDiscipline'])->name('admin.disciplines.create');

// departments
Route::get('/departments/', [\App\Http\Controllers\Api\Admin\AdminController::class, 'getDepartments'])->name('admin.departments');
