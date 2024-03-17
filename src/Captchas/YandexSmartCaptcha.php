<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

class YandexSmartCaptcha extends AbstractCaptcha
{
    /**
     * {@inheritDoc}
     */
    public function js(): string
    {
        return sprintf('<script src="%s" defer></script>', $this->clientUrl());
    }

    /**
     * {@inheritDoc}
     */
    public function html(): string
    {
        return sprintf('<div %s></div>', $this->withAttributes([
            'class' => 'smart-captcha',
            'data-hl' => $this->resolveCaptchaLocale(),
        ])->buildAttributes());
    }

    /**
     * Get client widget URL
     */
    protected function clientUrl(): string
    {
        return 'https://smartcaptcha.yandexcloud.net/captcha.js';
    }

    protected function resolveCaptchaLocale()
    {
        return match ($locale = config('captchas.options.yandex.hl')) {
            'navigator' => null,
            'locale' => app()->getLocale(),
            default => $locale,
        };
    }
}
