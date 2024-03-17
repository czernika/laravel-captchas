<?php

declare(strict_types=1);

namespace Czernika\Captchas\Contracts;

interface Captcha
{
    /**
     * Get client widget script
     *
     * @return string
     */
    public function js(): string;

    /**
     * Get widget HTML
     *
     * @return string
     */
    public function html(): string;
}
