<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\EstimateFile\Http\Controllers\EstimateFileController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/estimateFile'

], function ($router) {
    Route::get('/index/{id}', [EstimateFileController::class, 'get']);
});
