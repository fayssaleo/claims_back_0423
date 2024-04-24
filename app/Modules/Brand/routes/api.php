<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Brand\Http\Controllers\BrandController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/brand'

], function ($router) {
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/{id}', [BrandController::class, 'get']);
    Route::get('/index/equipment', [BrandController::class, 'indexEquipment']);
    Route::get('/index/automobile', [BrandController::class, 'indexAutomobile']);


    Route::post('/create', [BrandController::class, 'create']);
    Route::post('/update', [BrandController::class, 'update']);
    Route::post('/delete', [BrandController::class, 'delete']);
});
