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

    /*
    |--------------------------------------------------------------------------
    | Default captcha
    |--------------------------------------------------------------------------
    |
    | Defined captcha will be used
    |
    | Options: "yandex"
    |
    | Default: "yandex"
    */

    'default' => env('CAPTCHA_PROVIDER', 'yandex'),

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
            | Options: "navigator", "locale" or predefined list of locales:
            | 'ru' | 'en' | 'be' | 'kk' | 'tt' | 'uk' | 'uz' | 'tr'
            |
            | @see https://cloud.yandex.ru/en/docs/smartcaptcha/concepts/widget-methods#common-method
            |
            | Default: "navigator"
            */

            'hl' => 'navigator',

            /*
            |--------------------------------------------------------------------------
            | Callback function name
            |--------------------------------------------------------------------------
            |
            | Name of the JavaScript function to handle callback event. Accepts token as parameter
            |
            | @example `callback` was passed as value:
            |   <script>
            |        function callback(token) {
            |            console.log(callback);
            |        }
            |   </script>
            |  {!! Captcha::js() !!}
            |
            | @see https://cloud.yandex.ru/en/docs/smartcaptcha/concepts/widget-methods
            |
            | @var string|null
            |
            | Default: "null"
            */

            'callback' => null,

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

        'extended_yandex' => [
            /**
             * Same values as for `yandex`
             */
            'hl' => 'navigator',

            'send_ip' => false,

            /*
            |--------------------------------------------------------------------------
            | Widget options
            |--------------------------------------------------------------------------
            |
            | List of supported options for Yandex SmartCaptcha widget
            |
            | @see https://cloud.yandex.ru/en/docs/smartcaptcha/concepts/widget-methods#extended-method
            */

            'widget' => [
                'test' => false,

                'webview' => false,

                'invisible' => false,

                'shieldPosition' => 'bottom-right',

                'hideShield' => false,
            ],

            /*
            |--------------------------------------------------------------------------
            | Extra view template
            |--------------------------------------------------------------------------
            |
            | When option is set to any string value but empty ('') it will be considered as
            | blade template to include in extra scripts. In this template you have access
            | to `smartCaptchaWidgetId` JS variable which is basically widget itself
            |
            | @example content of template as it is
            | const unsubscribe = window.smartCaptcha.subscribe(
            |       smartCaptchaWidgetId,
            |       'challenge-visible',
            |       () => console.log('challenge is visible')
            |);
            |
            | @see https://cloud.yandex.ru/en/docs/smartcaptcha/concepts/widget-methods
            |
            | @var string
            |
            | Default: "''"
            */

            'subscription_view' => '',
        ],
    ],
];
