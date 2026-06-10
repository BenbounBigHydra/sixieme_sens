<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;
use App\Http\Controllers\CoBrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Middleware\TrackCollectionVisit;

// Site vitrine
Route::get('/', [VitrinController::class, 'home']);
Route::get('/trophees', [VitrinController::class, 'trophies']);
Route::get('/label', [VitrinController::class, 'label']);
Route::get('/companies', [VitrinController::class, 'companies']);
Route::get('/contact', [VitrinController::class, 'contact']);
Route::get('/quizz', [VitrinController::class, 'quizz']);
Route::get('/mentions', [VitrinController::class, 'mentions']);
Route::get('/politique', [VitrinController::class, 'politique']);
Route::get('/cookies', [VitrinController::class, 'cookies']);
Route::get('/teapot', function () {
    abort(418);
});
Route::get('/418', function () {
    abort(418);
});
Route::get('/414', function () {
    abort(418);
});

// Site co-branding
Route::prefix('/collection/{company_name}')->controller(CoBrandController::class)->middleware(TrackCollectionVisit::class)->group(function () {
    Route::get('/closed', 'closed')->name('cobrand.closed');
    Route::get('/{collection_id}', 'home');
    Route::get('/{collection_id}/infos', 'infos');
    Route::get('/{collection_id}/quizz', 'quizz');
});

// Site admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth')->prefix('admin')->group(function () {
    // Toutes ces routes nécessitent d'être connecté
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/collections', [AdminController::class, 'collections'])->name('collections');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/result', [AdminController::class, 'result'])->name('result');
    Route::get('/editorial-content', [AdminController::class, 'editorialContent'])->name('editorialContent');
});
