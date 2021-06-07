<?php

use App\Http\Controllers\API\EchartsController;
use App\Services\Chart\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/chart', [EchartsController::class, 'store']);

Route::get('/chart', [Charts::class, 'getJson']);

