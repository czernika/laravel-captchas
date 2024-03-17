<?php

use Czernika\Captchas\Rules\CaptchaResponseRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/workbench', 'workbench::welcome');

Route::post('/send-yandex', function (Request $request) {
    $request->validate([
        'smart-token' => ['required', 'string', new CaptchaResponseRule()],
    ]);

    return back();
});
