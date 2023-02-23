<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\memberController;

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

Route::post('/login',[authController::class, 'login']);
Route::post('/register',[authController::class, 'register']);
Route::post('/logout',[authController::class, 'logout']);

//Inicio das rotas para o Crud da parte de membros

Route::get('/allMember',[memberController::class, 'allMember']);
Route::post('/storeMember',[memberController::class, 'storeMember']);
Route::get('/editMember',[memberController::class, 'editMember']);
Route::post('/updateMember',[memberController::class, 'updateMember']);
Route::get('/deleteMember',[memberController::class, 'deleteMember']);