<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Contracts\Captcha;
use Czernika\Captchas\Enums\Provider;
use Czernika\Captchas\Views\Components\CaptchaComponent;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
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
     * Build HTML attributes as a string
     */
    protected function buildAttributes(): string
    {
        return $this->getAttributes()
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
    public function getAttributes(): Collection
    {
        return collect($this->attributes)
            ->put($this->siteKeyAttributeName, $this->clientKey)
            ->filter()
            ->unique();
    }

    /**
     * Render component
     */
    protected function renderHTML(Provider $provider, array $options = []): string
    {
        return Blade::renderComponent(
            (new CaptchaComponent($provider, $options))->withAttributes($this->getComponentAttributes())
        );
    }

    /**
     * Get component options in a key-value pairs
     * where key - HTML-attribute name, and value - its value
     * if value is `null` it will not be rendered
     */
    protected function getComponentAttributes(): array
    {
        return $this->withAttributes(
            $this->captchaAttributes()
        )->getAttributes()->toArray();
    }

    /**
     * Get attributes specific for captcha
     */
    protected function captchaAttributes(): array
    {
        return [];
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
