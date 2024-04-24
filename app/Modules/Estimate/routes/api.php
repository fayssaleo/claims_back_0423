<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Estimate\Http\Controllers\EstimateController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/estimates'
], function ($router) {
    Route::get('/indexEquipment/{id}', [EstimateController::class, 'indexEquipment']);
    Route::get('/indexContainer/{id}', [EstimateController::class, 'indexContainer']);
    Route::get('/indexAutomobile/{id}', [EstimateController::class, 'indexAutomobile']);
    Route::get('/indexVessel/{id}', [EstimateController::class, 'indexVessel']);
    Route::get('/{id}', [EstimateController::class, 'get']);
    Route::get('/CustomedField/{id}', [EstimateController::class, 'getCustomedFieldByEstimate']);
    Route::post('/create', [EstimateController::class, 'create']);
    Route::post('/update', [EstimateController::class, 'update']);
    Route::post('/update/container', [EstimateController::class, 'updateContainer']);
    Route::post('/update/automobile', [EstimateController::class, 'updateAutomobile']);
    Route::post('/update/vessel', [EstimateController::class, 'updateVessel']);
    Route::post('/delete', [EstimateController::class, 'delete']);
    Route::get('/file/sendEstimateFileStoragePath', [EstimateController::class, 'sendEstimateFileStoragePath']);
    Route::post('/file/Addfile', [EstimateController::class, 'Addfile']);
    Route::post('/file/delete', [EstimateController::class, 'deleteFile']);
});
