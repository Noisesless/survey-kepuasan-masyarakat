<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AdminController;

Route::get('/', [SurveyController::class, 'index']);
Route::post('/survey', [SurveyController::class, 'store']);
Route::get('/captcha', [SurveyController::class, 'generateCaptcha']);

Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/settings', [AdminController::class, 'settings']);
    Route::post('/admin/settings', [AdminController::class, 'updateSettings']);
    Route::get('/admin/export', [AdminController::class, 'export']);
    Route::get('/admin/surveys', [AdminController::class, 'listSurveys']);
    Route::delete('/admin/surveys/{id}', [AdminController::class, 'deleteSurvey']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/users', [AdminController::class, 'storeUser']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
});
Route::post('/logout', [AdminController::class, 'logout']);
