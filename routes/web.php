<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;

// Site vitrine
Route::get('/', [VitrinController::class, 'home']);
Route::get('/trophees', [VitrinController::class, 'trophies']);
Route::get('/label', [VitrinController::class, 'label']);
Route::get('/companies', [VitrinController::class, 'companies']);
Route::get('/collecte', [VitrinController::class, 'collecte']);
