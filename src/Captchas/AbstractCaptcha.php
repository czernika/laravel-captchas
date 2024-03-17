<?php

declare(strict_types=1);

namespace Czernika\Captchas\Captchas;

use Czernika\Captchas\Contracts\Captcha;

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
        protected readonly string $serverKey,
    ) {

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
}
