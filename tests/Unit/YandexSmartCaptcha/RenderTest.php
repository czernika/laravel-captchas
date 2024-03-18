<?php

use Czernika\Captchas\Captchas\YandexSmartCaptcha;

uses()->group('unit.yandex.render');

beforeEach(function () {
    $this->captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');
});

describe('HTML', function () {
    it('renders correct HTML with sitekey', function () {
        expect($this->captcha->html())->toContain('data-sitekey="CLIENT"');
    });

    it('does not renders optional attributes by default', function () {
        expect($this->captcha->html())
            ->not->toContain('data-hl')
            ->not->toContain('data-callback');
    });

    it('renders app locale if config value for hl set to locale', function () {
        config()->set('app.locale', 'by');
        config()->set('captchas.options.yandex.hl', 'locale');

        expect($this->captcha->html())->toContain('data-hl="by"');
    });

    it('renders app locale if config value for hl was set as any lang', function () {
        config()->set('captchas.options.yandex.hl', 'by');

        expect($this->captcha->html())->toContain('data-hl="by"');
    });

    it('renders callback function name if config value for callback was set', function () {
        config()->set('captchas.options.yandex.callback', 'myCallback');

        expect($this->captcha->html())->toContain('data-callback="myCallback"');
    });
});

describe('JS', function () {
    it('renders correct JS widget script', function () {
        expect($this->captcha->js())->toBe('<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>');
    });
});
