<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Closure;
use Czernika\Captchas\Captchas\YandexSmartCaptcha;

class CaptchaManager
{
    /**
     * Callback function to check host with
     *
     * @var Closure|null
     */
    protected static $checkHost = null;

    /**
     * List of available providers
     */
    protected static array $providers = [
        'yandex' => YandexSmartCaptcha::class,
    ];

    /**
     * Get available provider by key
     */
    public static function useProvider(string $key): string
    {
        return static::$providers[$key];
    }

    /**
     * Add new provider
     */
    public static function mapWith(string $key, string $provider): void
    {
        static::$providers[$key] = $provider;
    }

    /**
     * Set host check callback
     */
    public static function checkHostUsing(Closure $closure): void
    {
        static::$checkHost = $closure;
    }

    /**
     * Get check host callback
     */
    public static function getCheckHostCallback(): ?Closure
    {
        return static::$checkHost;
    }

    /**
     * Disable host checking
     */
    public static function disableCheckHost(): void
    {
        static::$checkHost = null;
    }
}
