<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO middleware for cross-server request
Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('auth.login');

Route::get('/departments', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{id}', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'show'])->name('departments.show');

Route::get('/disciplines', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'index'])->name('disciplines.index');
Route::get('/disciplines/{id}', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'show'])->name('disciplines.show');
Route::get('/disciplines/export/pdf', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'exportPdf'])->name('disciplines.export.pdf');

Route::get('/managers', [\App\Http\Controllers\Api\User\ManagerController::class, 'index'])->name('managers.index');
Route::get('/teachers', [\App\Http\Controllers\Api\User\TeacherController::class, 'index'])->name('teachers.index');
