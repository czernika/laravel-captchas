<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench;

    protected function getPackageAliases($app)
    {
        return [
            'Captcha' => 'Czernika\Captchas\Facades\Captcha',
        ];
    }
}
