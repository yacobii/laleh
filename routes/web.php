<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'HOME';
});

require __DIR__.'/settings.php';
