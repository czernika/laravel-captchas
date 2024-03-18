<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Enums\Provider;

class ExtendedYandexSmartCaptcha extends YandexSmartCaptcha
{
    public function clientUrl(): string
    {
        return 'https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=onloadFunction';
    }

    public function html(): string
    {
        return $this->renderHTML(Provider::EXTENDED_YANDEX, array_merge([
            'sitekey' => $this->clientKey,
            'hl' => $this->resolveCaptchaLocale(),
        ], config('captchas.options.'.Provider::EXTENDED_YANDEX->value.'.widget', [])));
    }

    public function getVerifyOptions(string $token): array
    {
        return array_filter([
            'secret' => $this->secret,
            'token' => $token,
            'ip' => config('captchas.options.'.Provider::EXTENDED_YANDEX->value.'.send_ip', false) ? request()->ip() : null,
        ]);
    }
}
