<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/event', function () {
    return view('event');
})->name('event');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
