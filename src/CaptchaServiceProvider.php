<?php

declare(strict_types=1);

namespace Czernika\Captchas;

use Czernika\Captchas\Captchas\YandexSmartCaptcha;
use Czernika\Captchas\Contracts\Captcha;
use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Captcha::class, function () {
            return new YandexSmartCaptcha(
                config('captchas.keys.client', ''),
                config('captchas.keys.secret', ''),
            );
        });
    }

    public function boot()
    {
        $this->loadConfig();
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

        return $this;
    }
}
