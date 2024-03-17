<?php

declare(strict_types=1);

namespace Czernika\Captchas\Facades;

use Czernika\Captchas\Contracts\Captcha as CaptchaContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string js()
 * @method static string html()
 */
class Captcha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CaptchaContract::class;
    }
}
