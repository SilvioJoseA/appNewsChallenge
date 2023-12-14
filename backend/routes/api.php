<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NYTNewsController;
use App\Http\Controllers\GuardianNewsController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\AlphaNewsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/alpha', [AlphaNewsController::class, 'getSources']);
Route::post('/alpha', [AlphaNewsController::class, 'getNews']);

Route::get('/noticias', [NewsController::class, 'obtenerNoticias']);
Route::get('/news/nyt', [NYTNewsController::class, 'getNews']);
Route::get('/news/nyt/app', [NYTNewsController::class, 'getNews1']);
Route::get('/news/guardian', [GuardianNewsController::class, 'getNews']);
Route::get('/news/guardian/app', [GuardianNewsController::class, 'getNews1']);
Route::post('/getnews', [NewsController::class, 'getNews']);
Route::post('/users/login', [UserController::class, 'findUser']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users/register', [UserController::class, 'store']);
Route::put('/users/{userId}/settings', [UserSettingController::class, 'update']);
Route::post('/settings', [UserSettingController::class , 'findSettings']);
Route::post('/settings/store', [UserSettingController::class , 'store']);

