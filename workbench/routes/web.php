<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/workbench', 'workbench::welcome');

Route::post('/send', function (Request $request) {
    return back();
});
