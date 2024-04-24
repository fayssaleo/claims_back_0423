<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\CustomedField\Http\Controllers\CustomedFieldController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/customedField'

], function ($router) {

    Route::get('/', [CustomedFieldController::class, 'index']);
    Route::get('/{id}', [CustomedFieldController::class, 'get']);
    Route::post('/create', [CustomedFieldController::class, 'create']);
    Route::post('/update', [CustomedFieldController::class, 'update']);
    Route::post('/delete', [CustomedFieldController::class, 'delete']);

});
