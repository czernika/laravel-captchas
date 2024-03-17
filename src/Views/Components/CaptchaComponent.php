<?php

declare(strict_types=1);

namespace Czernika\Captchas\Views\Components;

use Czernika\Captchas\Enums\Provider;
use Illuminate\View\Component;

class CaptchaComponent extends Component
{
    public function __construct(
        public Provider $provider,
    ) {

    }

    public function render()
    {
        return view('captcha::components.captcha');
    }
}
