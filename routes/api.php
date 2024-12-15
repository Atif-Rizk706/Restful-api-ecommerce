<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return  dd("iii");//$request->user();
});
Route::apiresource('/product',ProductController::class);
Route::group(['prefix'=>'products'],function (){
    Route::apiResource('/{product}/reviewers',\App\Http\Controllers\RewiersController::class);
});


