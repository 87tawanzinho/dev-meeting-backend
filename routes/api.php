<?php


use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[AuthController::class, 'login'] ); 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/createproject', [ProjectController::class, 'store']);

Route::get('/userprojects/{userId}', [ProjectController::class, 'userProjects']);