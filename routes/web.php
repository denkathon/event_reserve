<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
Route::get('/reserve', function () {
    return view('reservation-form'); // Laravelのビューを返す場合
});

Route::get('/confirm', function () {
    return view('confirmation'); // Laravelのビューを返す場合
});

Route::get('{any}', function () {
    return view('home');
})->where('any', '.*');