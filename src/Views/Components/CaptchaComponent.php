<?php

declare(strict_types=1);

namespace Czernika\Captchas\Views\Components;

use Czernika\Captchas\Contracts\Captcha;
use Illuminate\View\Component;

class CaptchaComponent extends Component
{
    public function render()
    {
        return view('captcha::components.captcha', [
            'captcha' => app(Captcha::class)->html(),
        ]);
    }
}
