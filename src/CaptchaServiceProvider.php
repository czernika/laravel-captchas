<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Czernika\Captchas\Contracts\Captcha;
use Czernika\Captchas\Views\Components\CaptchaComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Captcha::class, function () {
            $provider = CaptchaManager::useProvider(config('captchas.default', 'yandex'));

            return new $provider(
                config('captchas.keys.client', ''),
                config('captchas.keys.secret', ''),
            );
        });
    }

    public function boot()
    {
        $this
            ->loadConfig()
            ->loadViews();
    }

    /**
     * Load package config file
     */
    protected function loadConfig(): self
    {
        $configPath = dirname(__DIR__).'/config/captchas.php';

        $this->publishes([
            $configPath => config_path('captchas.php'),
        ]);

        $this->mergeConfigFrom($configPath, 'captchas');

        return $this;
    }

    /**
     * Load views
     */
    protected function loadViews(): self
    {
        Blade::component('captcha', CaptchaComponent::class);

        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'captcha');

        return $this;
    }
}
