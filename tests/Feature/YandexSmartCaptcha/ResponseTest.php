<?php

use Czernika\Captchas\CaptchaManager;
use Czernika\Captchas\Captchas\YandexSmartCaptcha;
use Czernika\Captchas\Exceptions\InvalidCaptchaResponseException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

uses()->group('feature.yandex.response');

describe('request', function () {
    it('it sends request with correct data', function () {
        $token = 'TOKEN';
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake();

        $captcha->getVerifyResponse($token);

        Http::assertSent(function (Request $request) use ($captcha, $token) {
            return $request->url() === $captcha->getVerifyUrlWithQueries($token) &&
                $request['secret'] === 'SECRET' &&
                $request['token'] === $token &&
                ! isset($request['ip']);
        });
    });

    it('it sends request with ip when config option set to true', function () {
        config()->set('captchas.options.yandex.send_ip', true);

        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake();

        $captcha->getVerifyResponse('TOKEN');

        Http::assertSent(function (Request $request) {
            return isset($request['ip']);
        });
    });
});

describe('success', function () {
    it('resolves successful response data', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'ok',
                'host' => '127.0.0.1',
            ]),
        ]);

        $data = $captcha->verifyResponse('TOKEN');

        expect($data->status)->toBe('ok'); // Meaning everything is OK
    });
});

describe('failure', function () {
    it('fails if hosts are empty even when status is ok', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'ok',
                'host' => '',
            ]),
        ]);

        $captcha->verifyResponse('TOKEN');
    })->throws(InvalidCaptchaResponseException::class, 'The cloud is blocked or an internal service failure occurred.');

    it('fails if status is not ok', function () {
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'failed',
                'host' => '127.0.0.1',
                'message' => 'Request failed because I told to.',
            ]),
        ]);

        $captcha->verifyResponse('TOKEN');
    })->throws(InvalidCaptchaResponseException::class, 'Request failed because I told to.');

    it('fails with custom handler even if response is OK', function () {
        CaptchaManager::checkHostsUsing(function (string $host) {
            throw_if($host === '127.0.0.1', InvalidCaptchaResponseException::class, 'Request failed because I told to.');
        });
        $captcha = new YandexSmartCaptcha('CLIENT', 'SECRET');

        Http::fake([
            'https://smartcaptcha.yandexcloud.net/*' => Http::response([
                'status' => 'ok',
                'host' => '127.0.0.1',
            ]),
        ]);

        $captcha->verifyResponse('TOKEN');

        CaptchaManager::disableCheckHosts();
    })->throws(InvalidCaptchaResponseException::class, 'Request failed because I told to.');
});
