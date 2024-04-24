<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\ShippingLine\Http\Controllers\ShippingLineController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/shippingLine'

], function ($router) {
    Route::get('/', [ShippingLineController::class, 'index']);
    Route::get('/{id}', [ShippingLineController::class, 'get']);
    Route::post('/create', [ShippingLineController::class, 'create']);
    Route::post('/update', [ShippingLineController::class, 'update']);
    Route::post('/delete', [ShippingLineController::class, 'delete']);


});
