<?php

declare(strict_types=1);

namespace Czernika\Captchas\Rules;

use Closure;
use Czernika\Captchas\Exceptions\InvalidCaptchaResponseException;
use Czernika\Captchas\Facades\Captcha;
use Illuminate\Contracts\Validation\ValidationRule;

class CaptchaResponseRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            Captcha::verifyResponse($value);

        } catch (InvalidCaptchaResponseException $e) { // @phpstan-ignore-line
            $fail(__($e->getMessage()));
        }
    }
}
