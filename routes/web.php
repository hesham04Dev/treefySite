<?php

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTranslatorIsAccepted;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\EnsureUserIsTranslator;
use App\Http\Middleware\EnsureUserIsNotTranslator;
use App\Services\PayPalService;
use Illuminate\Support\Facades\Session;




Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return redirect()->back();
})->name('locale.switch');





Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/home', function () {
    return view('home');
});


Route::middleware(['auth', EnsureUserIsTranslator::class, EnsureTranslatorIsAccepted::class])->group(function () {

    // Translator-only routes
    Route::get('/translator/dashboard', [TranslatorController::class, 'view_dashboard']);
    Route::get('translations/verification/{project_id}', [TranslatorController::class, 'view_verification'])->name('project.verify');
    Route::get('translations/verification', [TranslatorController::class, 'view_verification'])->name('verify');
});



Route::middleware(['auth'])->group(function () {
    Route::get("/profile", [ProfileController::class, "view_profile"]);
    Route::get("/add_project", [ProjectController::class, "view_addProject"])->name("add_project");
    Route::get("/project/{project_id}/edit", [ProjectController::class, "view_editProject"])->name("edit_project");
    // Route::get("/project", function () {
    //     return view('publisher.addProject');})->name("project");
    Route::get("/dashboard", [DashboardController::class, "view_dashboard"])->name("dashboard");
    Route::get("/user/fill_missing_data", [UserController::class, "view_fill_missing_data"]);
    Route::get('/projects', function () {
        return view('publisher.projects');
    })->name("projects");

    Route::get('/project/verifications/{project_id}', [ProjectController::class, 'view_Verification'])->name("projectVerifications");
});






// auth part
Route::get('logout', [AuthController::class, 'logout'])->name("logout");
Route::get('login', [AuthController::class, 'view_signin'])->name("login");
Route::post('login', [AuthController::class, 'signin']);
Route::get('signup', [AuthController::class, 'view_signup']);
Route::post('signup', [AuthController::class, 'signup']);

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// end auth part





Route::middleware(['auth'])->prefix('points')->group(function () {
    Route::get('/', [PointController::class, 'index'])->name('points.index');

    // Pages
    Route::get('/purchase', [PointController::class, 'showPurchaseForm'])->name('points.purchase.form');
    Route::get('/sell', [PointController::class, 'showSellForm'])->name('points.sell.form');
    Route::get('/transfer', [PointController::class, 'showTransferForm'])->name('points.transfer.form');

    // Actions
    Route::post('/purchase', [PointController::class, 'createPurchase'])->name('points.purchase');
    Route::post('/sell', [PointController::class, 'sellPoints'])->name('points.sell');
    Route::post('/transfer', [PointController::class, 'sendPoints'])->name('points.transfer');

    // PayPal
    Route::post('/paypal/create', [PointController::class, 'createPurchase'])->name('paypal.create');
    Route::get('/paypal/success', [PointController::class, 'purchaseSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [PointController::class, 'purchaseCancel'])->name('paypal.cancel');
});
