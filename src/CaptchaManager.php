<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Closure;

class CaptchaManager
{
    /**
     * Callback function to check hosts with
     *
     * @var Closure|null
     */
    protected static $checkHosts = null;

    /**
     * Set hosts check callback
     */
    public static function checkHostsUsing(Closure $closure): void
    {
        static::$checkHosts = $closure;
    }

    /**
     * Get check hosts callback
     */
    public static function getCheckHostsCallback(): ?Closure
    {
        return static::$checkHosts;
    }

    /**
     * Disable hosts checking
     */
    public static function disableCheckHosts(): void
    {
        static::$checkHosts = null;
    }
}
