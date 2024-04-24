<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Automobile\Http\Controllers\AutomobileController;


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/automobiles'
], function ($router) {
    Route::post('/createOrUpdateAutomobile', [AutomobileController::class, 'createOrUpdateAutomobile']);
    Route::get('/{claim_id}', [AutomobileController::class, 'index']);
    Route::post('/delete', [AutomobileController::class, 'delete']);
    Route::post('/makeItMajor', [AutomobileController::class, 'makeItMajor']);
    Route::post('/disableMajor', [AutomobileController::class, 'disableMajor']);
});
