<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;
use App\Http\Controllers\CoBrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

// Site vitrine
Route::get('/', [VitrinController::class, 'home']);
Route::get('/trophees', [VitrinController::class, 'trophies']);
Route::get('/label', [VitrinController::class, 'label']);
Route::get('/companies', [VitrinController::class, 'companies']);
Route::get('/contact', [VitrinController::class, 'contact']);

// Site co-branding
Route::get('/collection/{company_name}/closed', [CoBrandController::class, 'closed'])->name('cobrand.closed');
Route::get('/collection/{company_name}/{collection_id}', [CoBrandController::class, 'home']);
Route::get('/collection/{company_name}/{collection_id}/infos', [CoBrandController::class, 'infos']);
Route::get('/collection/{company_name}/{collection_id}/quizz', [CoBrandController::class, 'quizz']);

// Site admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Toutes ces routes nécessitent d'être connecté
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/collections', [AdminController::class, 'collections'])->name('collections');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/leaderboard', [AdminController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/editorial-content', [AdminController::class, 'editorialContent'])->name('editorialContent');
});
