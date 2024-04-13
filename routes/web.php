<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', ['data' => []]);
});

Route::post('/upload-csv', [\App\Http\Controllers\HandleUpload::class, 'file']);
