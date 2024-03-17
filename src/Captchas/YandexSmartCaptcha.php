<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

class YandexSmartCaptcha extends AbstractCaptcha
{
    /**
     * @inheritDoc
     */
    public function js(): string
    {
        return sprintf('<script src="%s" defer></script>', $this->clientUrl());
    }

    /**
     * @inheritDoc
     */
    public function html(): string
    {
        return sprintf('<div class="smart-captcha" data-sitekey="%s"></div>', $this->clientKey);
    }

    /**
     * Get client widget URL
     *
     * @return string
     */
    protected function clientUrl(): string
    {
        return 'https://smartcaptcha.yandexcloud.net/captcha.js';
    }
}
