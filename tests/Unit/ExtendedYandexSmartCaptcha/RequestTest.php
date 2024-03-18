<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;

uses()->group('unit.extended_yandex.request');

beforeEach(function () {
    $this->captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');
});

describe('options', function () {
    it('resolves correct method name', function () {
        expect($this->captcha->getVerifyMethod())->toBe('GET');
    });

    it('resolves correct verify URL', function () {
        expect($this->captcha->getVerifyUrl())
            ->toBeUrl()
            ->toBe('https://smartcaptcha.yandexcloud.net/validate');
    });

    it('resolves correct options', function () {
        expect($this->captcha->getVerifyOptions('TOKEN'))->toMatchArray([
            'token' => 'TOKEN',
            'secret' => 'SECRET',
        ]);
    });
});
