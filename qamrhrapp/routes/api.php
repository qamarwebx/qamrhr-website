<?php

use App\Http\Controllers\apps\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/users', [UserList::class, 'get_users']);
Route::post('/user/new', [UserList::class, 'create_user']);
