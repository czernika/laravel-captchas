<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;
use Czernika\Captchas\Captchas\YandexSmartCaptcha;

class CaptchaManager
{
    /**
     * List of available providers
     */
    protected static array $providers = [
        'yandex' => YandexSmartCaptcha::class,
        'extended_yandex' => ExtendedYandexSmartCaptcha::class,
    ];

    /**
     * Get available provider by key
     */
    public static function useProvider(string $key): string
    {
        return static::$providers[$key];
    }
}
