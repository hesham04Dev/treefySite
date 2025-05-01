<?php

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\EnsureUserIsTranslator;
use App\Http\Middleware\EnsureUserIsNotTranslator;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});


Route::middleware(['auth', EnsureUserIsTranslator::class])->group(function () {
    // Translator-only routes
    Route::get('/translator/dashboard', [TranslatorController::class, 'view_dashboard']);
    Route::get('translations/verification/{project_id}', [TranslatorController::class, 'view_verification'])->name('project.verify');
    Route::get('translations/verification', [TranslatorController::class, 'view_verification'])->name('verify');
});



Route::middleware(['auth'])->group(function () {
    Route::get("/add_project",[ProjectController::class,"view_addProject"])->name("add_project");
    Route::get("/project/{project_id}/edit",[ProjectController::class,"view_editProject"])->name("edit_project");
    // Route::get("/project", function () {
    //     return view('publisher.addProject');})->name("project");
    Route::get("/dashboard",[DashboardController::class,"view_dashboard"])->name("dashboard");
    Route::get("/user/fill_missing_data",[UserController::class,"view_fill_missing_data"]);
    Route::get('/projects', function () {
        return view('publisher.projects');
    })->name("projects");

    Route::get('/project/verifications/{project_id}', [ProjectController::class, 'view_Verification'])->name("projectVerifications");
});

Route::middleware(['auth',EnsureUserIsNotTranslator::class])->group(function () {
    
});





// auth part
Route::get('logout',[AuthController::class, 'logout'])->name("logout");
Route::get('login',[AuthController::class, 'view_signin'])->name("login");
Route::post('login',[AuthController::class, 'signin']);
Route::get('signup',[AuthController::class, 'view_signup']);
Route::post('signup',[AuthController::class, 'signup']);

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// end auth part
