<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Captcha keys
    |--------------------------------------------------------------------------
    |
    | You need to get two keys - public site key and account secret key
    | Both of them you should find at provider's dashboard
    |
    */

    'keys' => [
        'client' => env('CAPTCHA_CLIENT_KEY'),
        'secret' => env('CAPTCHA_SECRET'),
    ],
];
