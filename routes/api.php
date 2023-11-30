<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypesController;
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

Route::get('/user',[UserController::class,'index']);
Route::post('/user/store',[UserController::class,'store']);
Route::delete('/user/delete/{id}',[UserController::class,'delete']);
Route::post('/user/enrollclass',[UserController::class,'enrollclass']);

Route::get('/class',[ClassesController::class,'index']);
Route::get('/class/{id}',[ClassesController::class,'getClassbyID']);
Route::post('/class/store',[ClassesController::class,'store']);
Route::delete('/class/delete/{id}',[ClassesController::class,'delete']);

Route::get('/topic',[TopicController::class,'index']);
Route::get('/topic/{id}',[TopicController::class,'getTopicbyID']);
Route::post('/topic/store',[TopicController::class,'store']);
Route::delete('/topic/delete/{id}',[TopicController::class,'delete']);

Route::get('/comment',[CommentController::class,'index']);
//Route::get('/comment/{id}',[TopicController::class,'getTopicbyID']);
Route::post('/comment/store',[CommentController::class,'store']);
Route::delete('/comment/delete/{id}',[CommentController::class,'delete']);

Route::get('/usertype',[UserTypesController::class,'index']);
Route::get('/usertype/{id}',[UserTypesController::class,'getClassbyID']);
Route::post('/usertype/store',[UserTypesController::class,'store']);
Route::delete('/usertype/delete/{id}',[UserTypesController::class,'delete']);


