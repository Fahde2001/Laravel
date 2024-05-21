<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/user',[\App\Http\Controllers\Auth::class,'user']);

Route::get('/register',[\App\Http\Controllers\Auth::class ,'register']);
*/
