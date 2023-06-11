<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\memberController;

Route::post('/storeMember',[memberController::class, 'storeMember']);
Route::get('/allTask',[memberController::class, 'allMember']);
Route::get('/deleteTask/{$id}',[memberController::class, 'deleteTask']);