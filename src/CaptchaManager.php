<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Closure;

class CaptchaManager
{
    /**
     * Callback function to check host with
     *
     * @var Closure|null
     */
    protected static $checkHost = null;

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
