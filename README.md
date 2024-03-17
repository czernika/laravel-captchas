# Laravel Captchas

[![Tests](https://github.com/czernika/laravel-captchas/actions/workflows/tests.yml/badge.svg)](https://github.com/czernika/laravel-captchas/actions/workflows/tests.yml)

Adds captchas to your Laravel web app

## Compatibility

Tested for Laravel versions 10 and 11

| Version | PHP          | Laravel |
|---------|--------------|---------|
| 0.x     | 8.1/8.2/8.3  | 10.x    |
| 0.x     | 8.2/8.3      | 11.x    |

## Installation

...

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

### Options

## Testing

```sh
composer test
```

## License

Open source under [MIT License](LICENSE)
