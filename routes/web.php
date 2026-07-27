<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return "Welcome to NurseBuddy!";
});

Route::get('/dbconfig', function () {
    return view('dbconfig');
});