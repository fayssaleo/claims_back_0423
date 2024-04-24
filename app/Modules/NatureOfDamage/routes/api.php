<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\NatureOfDamage\Http\Controllers\NatureOfDamageController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/NatureOfDamage'

], function ($router) {
    Route::get('/', [NatureOfDamageController::class, 'index']);
    Route::get('/{id}', [NatureOfDamageController::class, 'get']);

    Route::get('/index/equipment', [NatureOfDamageController::class, 'indexEquipment']);
    Route::get('/index/automobile', [NatureOfDamageController::class, 'indexAutomobile']);
    Route::get('/index/container', [NatureOfDamageController::class, 'indexContainer']);
    Route::get('/index/vessel', [NatureOfDamageController::class, 'indexVessel']);
    
    Route::post('/create', [NatureOfDamageController::class, 'create']);
    Route::post('/update', [NatureOfDamageController::class, 'update']);
    Route::post('/delete', [NatureOfDamageController::class, 'delete']);
});
