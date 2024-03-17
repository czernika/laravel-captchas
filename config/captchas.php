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

    'options' => [

        'yandex' => [

            /*
            |--------------------------------------------------------------------------
            | Yandex SmartCaptcha locale
            |--------------------------------------------------------------------------
            |
            | Locale configuration. "navigator" will use user browser language (window.navigator.language),
            | "locale" option will resolve app locale and any other option will be resolved as is
            |
            | Yandex SmartCaptcha backups to English for unsupported values
            |
            | Supports "navigator", "locale" or predefined list of locales:
            | 'ru' | 'en' | 'be' | 'kk' | 'tt' | 'uk' | 'uz' | 'tr'
            |
            | @see https://cloud.yandex.ru/en/docs/smartcaptcha/concepts/widget-methods#common-method
            |
            | Default: "navigator"
            */

            'hl' => 'navigator',

            /*
            |--------------------------------------------------------------------------
            | Send user IP with request or not
            |--------------------------------------------------------------------------
            |
            | Allow to send user IP to SmartCaptcha server with request to help to improve it
            |
            | @var boolean
            |
            | Default: "false"
            */
    
            'send_ip' => false,
        ],
    ],
];
