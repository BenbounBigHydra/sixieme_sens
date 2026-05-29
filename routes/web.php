<?php

use App\Http\Controllers\CoBrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;

// Site vitrine
Route::get('/', [VitrinController::class, 'home']);
Route::get('/trophies', [VitrinController::class, 'trophies']);
Route::get('/label', [VitrinController::class, 'label']);
Route::get('/companies', [VitrinController::class, 'companies']);
Route::get('/contact', [VitrinController::class, 'contact']);

// Site co-branding
Route::get('/collection/{company_name}/{collection_id}', [CoBrandController::class, 'home']);
Route::get('/collection/{company_name}/{collection_id}/infos', [CoBrandController::class, 'infos']);
Route::get('/collection/{company_name}/{collection_id}/quizz', [CoBrandController::class, 'quizz']);
