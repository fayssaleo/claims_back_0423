<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\Company\Http\Controllers\CompanyController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/companie'

], function ($router) {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{id}', [CompanyController::class, 'get']);
    Route::get('/index/equipment', [CompanyController::class, 'indexEquipment']);
    Route::get('/index/automobile', [CompanyController::class, 'indexAutomobile']);
    Route::get('/index/vessel', [CompanyController::class, 'indexVessel']);
    Route::get('/index/container', [CompanyController::class, 'indexContainer']);


    Route::post('/create', [CompanyController::class, 'create']);
    Route::post('/update', [CompanyController::class, 'update']);
    Route::post('/delete', [CompanyController::class, 'delete']);
});
