<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VaultController;
use App\Http\Controllers\Api\BeneficiaryController;
use App\Http\Controllers\Api\LegacyItemController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('/vaults', VaultController::class);
    Route::apiResource('/beneficiaries', BeneficiaryController::class);
    Route::apiResource('/legacy-items', LegacyItemController::class);
});
