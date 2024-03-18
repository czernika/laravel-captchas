<?php

use Czernika\Captchas\Captchas\YandexSmartCaptcha;

uses()->group('unit.yandex.request');

beforeEach(function () {
    $this->captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');
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
