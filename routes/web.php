<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/event', function () {
    return redirect()->route('events');
})->name('event');

Route::get('/events/{slug}', function (string $slug) {
    return view('event-details', ['slug' => $slug]);
})->name('event.details');

Route::get('/event-details', function () {
    return view('event-details', ['slug' => 'techsummit-2026']);
})->name('event.details.default');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/inscription', function () {
    return view('inscription');
})->name('inscription');

Route::get('/organisateur', function () {
    return view('organisateur');
})->name('organisateur');
