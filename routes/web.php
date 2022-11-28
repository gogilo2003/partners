<?php

use Illuminate\Support\Facades\Route;

Route::get('partners', function () {
    return view('partners::partners');
})->middleware('guest');
