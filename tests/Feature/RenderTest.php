<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;
use Czernika\Captchas\Captchas\YandexSmartCaptcha;
use Czernika\Captchas\Contracts\Captcha;

uses()->group('feature.render');

beforeEach(function () {
    config()->set('captchas.keys.client', 'CLIENT');
    config()->set('captchas.keys.secret', 'SECRET');
});

describe('providers', function () {
    it('resolves default yandex provider', function () {
        $captcha = app(Captcha::class);

        expect($captcha)->toBeInstanceOf(YandexSmartCaptcha::class);
    });

    it('resolves custom provider', function () {
        config()->set('captchas.default', 'extended_yandex');

        $captcha = app(Captcha::class);

        expect($captcha)->toBeInstanceOf(ExtendedYandexSmartCaptcha::class);
    });
});
