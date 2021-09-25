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

// TODO проверка на то что статус пользователя - активный
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', [\App\Http\Controllers\Api\User\ProfileController::class, 'getUser'])->name('user.profile');
    Route::post('/user/profile/update', [\App\Http\Controllers\Api\User\ProfileController::class, 'updateProfile'])->name('user.profile.name');

    Route::post('/user/token/verify/resend', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'resendEmail'])->name('user.token.verify.resend');
    Route::get('/user/token/verify/{verificationToken}', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'verifyEmail'])->name('auth.token.verify');

});

// TODO middleware for cross-server request
Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('auth.register');
Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('auth.login');

Route::get('/departments', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'index'])->name('disciplines.index');
Route::get('/departments/{departmentSecondId}', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'show'])->name('disciplines.show');

Route::get('/disciplines', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'index'])->name('disciplines.index');
Route::get('/disciplines/{disciplineSecondId}', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'show'])->name('disciplines.show');
Route::get('/disciplines/export/pdf', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'exportPdf'])->name('disciplines.export.pdf');
Route::get('/disciplines/teachers/{disciplineSecondId}', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'teachers'])->name('disciplines.teachers');

Route::get('/managers', [\App\Http\Controllers\Api\User\ManagerController::class, 'index'])->name('managers.index');
Route::get('/managers/{managerId}', [\App\Http\Controllers\Api\User\ManagerController::class, 'show'])->name('managers.show');

Route::get('/teachers', [\App\Http\Controllers\Api\User\TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacherSecondId}', [\App\Http\Controllers\Api\User\TeacherController::class, 'show'])->name('teachers.show');
Route::get('/teachers/departments/grouped', [\App\Http\Controllers\Api\User\TeacherController::class, 'getGroupedTeachersByDepartments'])->name('teachers.disciplines.grouped');
