<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\EquipmentMatricule\Http\Controllers\EquipmentMatriculeController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/EquipmentMatricule'

], function ($router) {
    Route::get('/{equipment?}', [EquipmentMatriculeController::class, 'index']);
    Route::get('/index/{id}', [EquipmentMatriculeController::class, 'get']);


    Route::post('/create', [EquipmentMatriculeController::class, 'create']);
    Route::post('/update', [EquipmentMatriculeController::class, 'update']);
    Route::post('/delete', [EquipmentMatriculeController::class, 'delete']);
});
