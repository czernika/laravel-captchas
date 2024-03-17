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
}
