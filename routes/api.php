<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('layer', 'App\Http\Controllers\Api\LayerController')
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('logistic-facility-type', 'App\Http\Controllers\Api\LogisticFacilityTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('logistic-facility', 'App\Http\Controllers\Api\LogisticFacilityController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
