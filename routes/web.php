<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('customer.index');
})->name('home');
