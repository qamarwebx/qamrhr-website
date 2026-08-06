<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentications\LoginBasic;

Route::post('/auth/login', [LoginBasic::class, 'login']);
Route::put('/auth/user/{user}/update', [LoginBasic::class, 'update']);
Route::put('/auth/password/{user}/change', [LoginBasic::class, 'change_password']);
Route::delete('/auth/{user}/delete', [LoginBasic::class, 'destroy']);
