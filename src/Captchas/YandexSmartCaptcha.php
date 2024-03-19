<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Enums\Provider;
use Czernika\Captchas\Events\SendingVerifyRequest;
use Czernika\Captchas\Events\VerifyRequestSent;
use Czernika\Captchas\Exceptions\InvalidCaptchaResponseException;

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
        return $this->renderHTML(Provider::YANDEX);
    }

    /**
     * {@inheritDoc}
     */
    protected function captchaAttributes(): array
    {
        return [
            'data-hl' => $this->resolveCaptchaLocale(),
            'data-callback' => config('captchas.options.'.Provider::YANDEX->value.'.callback'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function clientUrl(): string
    {
        return 'https://smartcaptcha.yandexcloud.net/captcha.js';
    }

    /**
     * Resolve captcha `hl` option value
     */
    protected function resolveCaptchaLocale(): ?string
    {
        return match ($locale = config('captchas.options.'.Provider::YANDEX->value.'.hl')) {
            'navigator' => null,
            'locale' => app()->getLocale(),
            default => $locale,
        };
    }

    /**
     * {@inheritDoc}
     */
    public function getVerifyMethod(): string
    {
        return 'GET';
    }

    /**
     * {@inheritDoc}
     */
    public function getVerifyUrl(): string
    {
        return 'https://smartcaptcha.yandexcloud.net/validate';
    }

    /**
     * {@inheritDoc}
     */
    public function getVerifyOptions(string $token): array
    {
        return array_filter([
            'secret' => $this->secret,
            'token' => $token,
            'ip' => config('captchas.options.'.Provider::YANDEX->value.'.send_ip', false) ? request()->ip() : null,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function verifyResponse(string $token): mixed
    {
        SendingVerifyRequest::dispatch($token);

        $response = $this->getVerifyResponse($token);

        $data = $response->object();

        if ($data->status !== 'ok') {
            throw new InvalidCaptchaResponseException(
                isset($data->message) ? $data->message : 'Request failure.'
            );
        }

        // Empty host field. This may indicate that the cloud is blocked
        // or an internal service failure occurred even if status is "ok"
        if (isset($data->host) && $data->host === '') {
            throw new InvalidCaptchaResponseException('The cloud is blocked or an internal service failure occurred.');
        }

        VerifyRequestSent::dispatch($token, $data);

        return $data;
    }
}
