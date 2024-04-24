<?php

use App\Modules\Claim\Http\Controllers\ClaimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/claims'

], function ($router) {
    Route::post('/indexClaimsByIds', [ClaimController::class, 'indexClaimsByIds']);
    Route::get('/indexClaims', [ClaimController::class, 'indexClaims']);
    Route::get('/indexClaimsByMonth/{monthAndYear}', [ClaimController::class, 'indexClaimsByMonth']);
    Route::get('/indexIncidents', [ClaimController::class, 'indexIncidents']);
    Route::get('/indexIncidentsByMonth/{monthAndYear}', [ClaimController::class, 'indexIncidentsByMonth']);
    Route::get('/{id}', [ClaimController::class, 'get']);
    Route::post('getDownloadsFiles', [ClaimController::class, 'getDownloadsFiles']);
    Route::post('/treated', [ClaimController::class, 'treated']);
    Route::post('/closed', [ClaimController::class, 'closed']);
    Route::post('/paid', [ClaimController::class, 'paid']);
    Route::post('/reinvoiced', [ClaimController::class, 'reinvoiced']);
    Route::post('/paid', [ClaimController::class, 'paid']);
    Route::post('/create', [ClaimController::class, 'create']);
    Route::post('/update', [ClaimController::class, 'update']);
    Route::post('/delete', [ClaimController::class, 'delete']);
});
