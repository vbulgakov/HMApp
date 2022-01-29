<?php

use App\Http\Controllers\API\PeopleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\InterestController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'people', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/',[PeopleController::class, 'index']);
    Route::post('add',[PeopleController::class, 'store']);
    Route::get('edit/{id}',[PeopleController::class, 'edit']);
    Route::post('update/{id}',[PeopleController::class, 'update']);
    Route::delete('delete/{id}',[PeopleController::class, 'destroy']);
});

Route::group(['prefix' => 'language', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/',[LanguageController::class, 'index']);
    Route::post('add',[LanguageController::class, 'store']);
    Route::get('edit/{id}',[LanguageController::class, 'edit']);
    Route::post('update/{id}',[LanguageController::class, 'update']);
    Route::delete('delete/{id}',[LanguageController::class, 'destroy']);
});

Route::group(['prefix' => 'interest', 'middleware' => 'auth:sanctum'], function(){
    Route::get('/',[InterestController::class, 'index']);
    Route::post('add',[InterestController::class, 'store']);
    Route::get('edit/{id}',[InterestController::class, 'edit']);
    Route::post('update/{id}',[InterestController::class, 'update']);
    Route::delete('delete/{id}',[InterestController::class, 'destroy']);
});

