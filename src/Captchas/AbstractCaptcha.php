<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Contracts\Captcha;

abstract class AbstractCaptcha implements Captcha
{
    public function __construct(
        protected readonly string $clientKey,
        protected readonly string $serverKey,
    )
    {
        
    }
}
