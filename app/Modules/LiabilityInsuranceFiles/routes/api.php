<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\LiabilityInsuranceFiles\Http\Controllers\LiabilityInsuranceFilesController;



Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/LiabilityInsuranceFiles'

], function ($router) {
    Route::post('/equipment', [LiabilityInsuranceFilesController::class, 'get']);
    Route::post('/automobile', [LiabilityInsuranceFilesController::class, 'getAutomobile']);
    Route::post('/container', [LiabilityInsuranceFilesController::class, 'getContainer']);
    Route::post('/vessel', [LiabilityInsuranceFilesController::class, 'getVessel']);

});
