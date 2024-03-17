<?php

use Czernika\Captchas\Captchas\YandexSmartCaptcha;

uses()->group('unit.yandex.render');

describe('HTML', function () {
    it('renders correct HTML with sitekey', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->toContain('data-sitekey="CLIENT"');
    });

    it('does not renders locale by default', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->not->toContain('data-hl');
    });

    it('renders app locale if config value for hl set to locale', function () {
        config()->set('app.locale', 'by');
        config()->set('captchas.options.yandex.hl', 'locale');

        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->toContain('data-hl="by"');
    });

    it('renders app locale if config value for hl was set as any lang', function () {
        config()->set('captchas.options.yandex.hl', 'by');

        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->toContain('data-hl="by"');
    });
});

describe('JS', function () {
    it('renders correct JS widget script', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->js())->toBe('<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>');
    });
});
