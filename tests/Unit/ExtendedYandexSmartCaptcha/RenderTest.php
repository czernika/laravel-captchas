<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;

uses()->group('unit.extended_yandex.render');

describe('HTML', function () {
    it('renders container', function () {
        $captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->html())->toContain('id="smartcaptcha-container"');
    });
});

describe('JS', function () {
    it('renders correct JS widget script', function () {
        $captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->js())->toBe('<script src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=onloadFunction" defer></script>');
    });
});
