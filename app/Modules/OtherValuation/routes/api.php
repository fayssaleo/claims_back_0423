<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\OtherValuation\Http\Controllers\OtherValuationController;


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/otherValuation'

], function ($router) {
    Route::get('/', [OtherValuationController::class, 'index']);
    Route::get('/index/{id}', [OtherValuationController::class, 'get']);
    Route::post('/create', [OtherValuationController::class, 'create']);
    Route::post('/update', [OtherValuationController::class, 'update']);
    Route::post('/delete', [OtherValuationController::class, 'delete']);

});
