<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/', function () {
    return "rota padrão";
});

Route::apiResource('user', UserController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('post', PostController::class);
Route::apiResource('comment', CommentController::class);
