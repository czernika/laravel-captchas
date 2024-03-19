<?php

use Czernika\Captchas\Captchas\ExtendedYandexSmartCaptcha;
use Czernika\Captchas\Exceptions\InvalidCaptchaResponseException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses()->group('feature.extended_yandex.response');

beforeEach(function () {
    Event::fake();
    $this->captcha = new ExtendedYandexSmartCaptcha('CLIENT', 'SECRET');
});

describe('request', function () {
    it('it sends request with correct data', function () {
        $token = 'TOKEN';
        Http::fake();

        $this->captcha->getVerifyResponse($token);

        Http::assertSent(function (Request $request) use ($token) {
            return $request->url() === $this->captcha->getVerifyUrlWithQueries($token) &&
                $request['secret'] === 'SECRET' &&
                $request['token'] === $token &&
                ! isset($request['ip']);
        });
    });

    it('it sends request with ip when config option set to true', function () {
        config()->set('captchas.options.extended_yandex.send_ip', true);

        Http::fake();

        $this->captcha->getVerifyResponse('TOKEN');

        Http::assertSent(function (Request $request) {
            return isset($request['ip']);
        });
    });
});

describe('success', function () {
    it('resolves successful response data', function () {
        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'ok',
                'host' => '127.0.0.1',
            ]),
        ]);

        $data = $this->captcha->verifyResponse('TOKEN');

        expect($data->status)->toBe('ok'); // Meaning everything is OK
    });
});

describe('failure', function () {
    it('fails if hosts are empty even when status is ok', function () {
        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'ok',
                'host' => '',
            ]),
        ]);

        $this->captcha->verifyResponse('TOKEN');
    })->throws(InvalidCaptchaResponseException::class, 'The cloud is blocked or an internal service failure occurred.');

    it('fails if status is not ok', function () {
        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'failed',
                'host' => '127.0.0.1',
                'message' => 'Request failed because I told to.',
            ]),
        ]);

        $this->captcha->verifyResponse('TOKEN');
    })->throws(InvalidCaptchaResponseException::class, 'Request failed because I told to.');
});
