<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\ApiRewardsController;
use App\Http\Controllers\Api\ApiCollectionController;
use App\Http\Controllers\Api\ApiCompanyController;

Route::get('/trophies/{year?}', [ApiRewardsController::class, 'winner']);
Route::get('/labels/{year?}', [ApiRewardsController::class, 'labelledCompanies']);

Route::middleware(['web', 'auth'])->group(function () {
Route::get('/collection/{id}', [ApiCollectionController::class, 'show']);
Route::post('/collection', [ApiCollectionController::class, 'store']);
Route::put('/collection/{id}', [ApiCollectionController::class, 'update']);
Route::delete('/collection/{id}', [ApiCollectionController::class, 'destroy']);

Route::patch('/collection/{id}/close', [ApiCollectionController::class, 'close']);
Route::get('/collections/{year?}', [ApiCollectionController::class, 'index']);

Route::get('/company/{id}', [ApiCompanyController::class, 'show']);
Route::post('/company', [ApiCompanyController::class, 'store']);
Route::put('/company/{id}', [ApiCompanyController::class, 'update']);
Route::delete('/company/{id}', [ApiCompanyController::class, 'destroy']);
});
