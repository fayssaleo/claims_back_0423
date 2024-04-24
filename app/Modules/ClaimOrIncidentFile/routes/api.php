<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\ClaimOrIncidentFile\Http\Controllers\ClaimOrIncidentFileController;



Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/ClaimOrIncidentFile'

], function ($router) {
    Route::get('/{id}', [ClaimOrIncidentFileController::class, 'get']);

});
