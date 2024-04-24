<?php

use App\Modules\Equipment\Http\Controllers\EquipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/equipments'

], function ($router) {
    Route::get('/{claim_id}', [EquipmentController::class, 'index']);
    Route::post('/createOrUpdateEquipment', [EquipmentController::class, 'createOrUpdateEquipment']);
    Route::get('/getIncidentReportsFilePath', [EquipmentController::class, 'getIncidentReportsFilePath']);
    Route::post('/delete', [EquipmentController::class, 'delete']);
    Route::post('/makeItMajor', [EquipmentController::class, 'makeItMajor']);
    Route::post('/disableMajor', [EquipmentController::class, 'disableMajor']);
});
