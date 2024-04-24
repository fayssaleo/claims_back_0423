<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Container\Http\Controllers\ContainerController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/containers'

], function ($router) {
    Route::get('/{claim_id}', [ContainerController::class, 'index']);
    Route::post('/createOrUpdateContainer', [ContainerController::class, 'createOrUpdateContainer']);
    Route::post('/delete', [ContainerController::class, 'delete']);


});
