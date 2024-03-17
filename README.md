# Laravel Captchas

[![Tests](https://github.com/czernika/laravel-captchas/actions/workflows/tests.yml/badge.svg)](https://github.com/czernika/laravel-captchas/actions/workflows/tests.yml)

Adds captchas to your Laravel web app

## Compatibility

Tested for Laravel versions 10 and 11

| Version | PHP          | Laravel |
|---------|--------------|---------|
| 0.x     | 8.1/8.2/8.3  | 10.x    |
| 0.x     | 8.2/8.3      | 11.x    |

## Roadmap

- [x] - [Yandex SmartCaptcha](https://cloud.yandex.ru/en/docs/smartcaptcha/quickstart)
- [ ] - Extended Yandex SmartCaptcha widget (For now can be used with [Vue3 SmartCaptcha component](https://github.com/czernika/vue3-smart-captcha))
- [ ] - Google reCaptcha v2
- [ ] - Google reCaptcha v3
- [ ] - hCaptcha

## Installation

```sh
composer require czernika/laravel-captchas
```

Next you need to add client and server keys into `.env` file

```
CAPTCHA_CLIENT_KEY=
CAPTCHA_SECRET=
```

## Configuration

Publish configuration file

```sh
php artisan vendor:publish --provider="Czernika\\Captchas\\CaptchaServiceProvider"
```

Every configuration option has self-explanatory comments

### Validate host manually

You may check host from where request sent manually

*NOTE: tested only with Yandex SmartCaptcha*

To do so register custom handler in ServiceProvider

```php
use Czernika\Captchas\CaptchaManager;

CaptchaManager::checkHostUsing(function (string $host) {
    // Check $host against
    // Need to throw \Czernika\Captchas\InvalidCaptchaResponseException

    if ($host !== 'my-host.com') {
        throw new \Czernika\Captchas\InvalidCaptchaResponseException('Host is not valid');
    }
});
```

## Testing

```sh
composer test
```

## License

Open source under [MIT License](LICENSE)
