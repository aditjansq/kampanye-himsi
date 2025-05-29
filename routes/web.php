<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/kabinet', function () {
    return view('kabinet');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/visi-misi', function () {
    return view('visi-misi');
});

Route::get('/proker', function () {
    return view('proker');
});

