<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiresource('/product',ProductController::class);
Route::group(['prefix'=>'products'],function (){
    Route::apiResource('/{product}/reviews',\App\Http\Controllers\RewiersController::class);
});


