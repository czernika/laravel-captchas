<?php

declare(strict_types=1);

namespace Czernika\Captchas\Contracts;

interface Captcha
{
    /**
     * Get client widget script
     */
    public function js(): string;

    /**
     * Get widget HTML
     */
    public function html(): string;

    /**
     * Get verify method
     */
    public function getVerifyMethod(): string;

    /**
     * Get captcha server verify URL
     */
    public function getVerifyUrl(): string;

    /**
     * Get options to send when verifying response
     */
    public function getVerifyOptions(string $token): array;

    /**
     * Verify captcha response
     *
     * @throws \Czernika\Captchas\Exceptions\InvalidCaptchaResponseException
     */
    public function verifyResponse(string $token): mixed;
}
