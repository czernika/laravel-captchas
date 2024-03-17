<?php

declare(strict_types=1);

namespace Czernika\Captchas\Facades;

use Czernika\Captchas\Contracts\Captcha as CaptchaContract;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string js()
 * @method static string html()
 * @method static \Illuminate\Http\Client\Response getVerifyResponse(string $token)
 * @method static object verifyResponse(string $token)
 */
class Captcha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CaptchaContract::class;
    }
}
