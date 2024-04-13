<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Welcome', ['data' => []]);
});

Route::post('/upload-csv', [\App\Http\Controllers\HandleUpload::class, 'file'])->name('uploadCsv');
