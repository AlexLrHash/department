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

Route::group(['middleware' => 'auth:sanctum'], function() {
    // User Profile
    Route::get('/user', [\App\Http\Controllers\Api\User\ProfileController::class, 'getUser'])->name('user.profile');
    Route::post('/user/profile/update', [\App\Http\Controllers\Api\User\ProfileController::class, 'updateProfile'])->name('user.profile.name');

    // User Avatar
    Route::post('/user/avatar/upload', [\App\Http\Controllers\Api\User\ProfileController::class, 'uploadAvatar'])->name('user.avatar.upload');
    Route::get('/user/avatar/download', [\App\Http\Controllers\Api\User\ProfileController::class, 'downloadAvatar'])->name('user.avatar.download');

    // Verification
    Route::post('/user/token/verify/resend', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'resendEmail'])->name('user.token.verify.resend');
    Route::post('/user/token/verify/', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'verifyEmail'])->name('auth.token.verify');
});

// Register
Route::post('/register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('auth.register');
// Login
Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('auth.login');

// Social
Route::get('/vk/auth/', [\App\Http\Controllers\Api\Auth\SocialController::class, 'index'])->name('vk.auth.index');
Route::get('/vk/auth/callback', [\App\Http\Controllers\Api\Auth\SocialController::class, 'callback'])->name('vk.auth.callback');

// Departments
Route::get('/departments', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{departmentSecondId}', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'show'])->name('departments.show');
Route::get('/departments/export/excel', [\App\Http\Controllers\Api\Department\DepartmentController::class, 'exportExcel'])->name('departments.export.excel');

// Disciplines
Route::get('/disciplines', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'index'])->name('disciplines.index');
Route::get('/disciplines/{disciplineSecondId}', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'show'])->name('disciplines.show');
Route::get('/disciplines/export/pdf', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'exportPdf'])->name('disciplines.export.pdf');
Route::get('/disciplines/export/excel', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'exportExcel'])->name('disciplines.export.excel');
Route::get('/disciplines/import/excel', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'importExcel'])->name('disciplines.import.excel');
Route::get('/disciplines/teachers/{disciplineSecondId}', [\App\Http\Controllers\Api\Discipline\DisciplineController::class, 'teachers'])->name('disciplines.teachers');

// Managers
Route::get('/managers', [\App\Http\Controllers\Api\User\ManagerController::class, 'index'])->name('managers.index');
Route::get('/managers/{managerId}', [\App\Http\Controllers\Api\User\ManagerController::class, 'show'])->name('managers.show');

// Teachers
Route::get('/teachers', [\App\Http\Controllers\Api\User\TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacherSecondId}', [\App\Http\Controllers\Api\User\TeacherController::class, 'show'])->name('teachers.show');
Route::get('/teachers/departments/grouped', [\App\Http\Controllers\Api\User\TeacherController::class, 'getGroupedTeachersByDepartments'])->name('teachers.disciplines.grouped');
Route::get('/teachers/export/excel', [\App\Http\Controllers\Api\User\TeacherController::class, 'exportExcel'])->name('teachers.export.excel');
