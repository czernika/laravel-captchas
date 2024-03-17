<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Contracts\Captcha;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

abstract class AbstractCaptcha implements Captcha
{
    /**
     * HTML-attributes
     */
    protected array $attributes = [];

    /**
     * Data-sitekey HTML attribute name
     */
    protected string $siteKeyAttributeName = 'data-sitekey';

    public function __construct(
        protected readonly string $clientKey,
        protected readonly string $secret,
    ) {

    }

    /**
     * Get full URL
     */
    public function getVerifyUrlWithQueries(string $token): string
    {
        return $this->getVerifyUrl().'?'.Arr::query($this->getVerifyOptions($token));
    }

    /**
     * Add more attributes
     */
    protected function withAttributes(array $attributes): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * Build HTML attributes
     */
    protected function buildAttributes(): string
    {
        return collect($this->getAttributes())
            ->put($this->siteKeyAttributeName, $this->clientKey)
            ->filter()
            ->map(fn ($value, $attribute) => sprintf('%s="%s"', $attribute, $value))
            ->join(' ');
    }

    /**
     * Add new attribute
     *
     * @param  mixed  $value
     */
    public function addAttribute(string $key, $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get raw list of attributes
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Get client response object from verify request
     */
    public function getVerifyResponse(string $token): Response
    {
        $method = Str::lower($this->getVerifyMethod());

        $response = Http::{$method}($this->getVerifyUrl(), $this->getVerifyOptions($token));

        return $response;
    }
}
