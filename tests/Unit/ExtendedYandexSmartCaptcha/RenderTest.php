<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;

uses()->group('unit.extended_yandex.render');

beforeEach(function () {
    $this->captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');
});

describe('HTML', function () {
    it('renders container', function () {
        expect($this->captcha->html())->toContain('id="smartcaptcha-container"');
    });

    it('renders extra template when passed', function () {
        config()->set('captchas.options.extended_yandex.subscription_view', 'workbench::scripts');

        expect($this->captcha->html())->toContain('challenge is visible');
    });
});

describe('JS', function () {
    it('renders correct JS widget script', function () {
        expect($this->captcha->js())->toBe('<script src="https://smartcaptcha.yandexcloud.net/captcha.js?render=onload&onload=onloadFunction" defer></script>');
    });
});
