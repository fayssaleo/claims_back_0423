<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\TypeOfEquipment\Http\Controllers\TypeOfEquipmentController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/TypeOfEquipment'

], function ($router) {
    Route::get('/indexAll', [TypeOfEquipmentController::class, 'indexAll']);
    Route::get('/indexAll2', [TypeOfEquipmentController::class, 'indexAll2']);
    Route::get('/', [TypeOfEquipmentController::class, 'index']);
    Route::get('/{id}', [TypeOfEquipmentController::class, 'get']);
    Route::get('/index/equipment', [TypeOfEquipmentController::class, 'indexEquipment']);
    Route::get('/index/automobile', [TypeOfEquipmentController::class, 'indexAutomobile']);

    Route::post('/create', [TypeOfEquipmentController::class, 'create']);
    Route::post('/update', [TypeOfEquipmentController::class, 'update']);
    Route::post('/delete', [TypeOfEquipmentController::class, 'delete']);
});
