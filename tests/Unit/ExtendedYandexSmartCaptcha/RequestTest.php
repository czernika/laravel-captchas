<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;

uses()->group('unit.extended_yandex.request');

describe('options', function () {
    it('resolves correct method name', function () {
        $captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->getVerifyMethod())->toBe('GET');
    });

    it('resolves correct verify URL', function () {
        $captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->getVerifyUrl())
            ->toBeUrl()
            ->toBe('https://smartcaptcha.yandexcloud.net/validate');
    });

    it('resolves correct options', function () {
        $captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');

        expect($captcha->getVerifyOptions('TOKEN'))->toMatchArray([
            'token' => 'TOKEN',
            'secret' => 'SECRET',
        ]);
    });
});
