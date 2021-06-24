<?php

use App\Http\Controllers\API\EchartsController;
use App\Services\Chart\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/chart', [EchartsController::class, '__invoke']);
Route::post('/custom', [EchartsController::class, 'createChart']);

