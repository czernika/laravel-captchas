<?php

use Czernika\Captchas\Captchas\YandexSmartCaptcha;

uses()->group('unit.yandex.render');

describe('HTML', function () {
    it('renders correct HTML with sitekey', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->toContain('data-sitekey="CLIENT"');
    });
});

describe('JS', function () {
    it('renders correct JS widget script', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->js())->toBe('<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>');
    });
});
