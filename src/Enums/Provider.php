<?php

declare(strict_types=1);

namespace Czernika\Captchas\Enums;

enum Provider: string
{
    case YANDEX = 'yandex';

    case EXTENDED_YANDEX = 'extended_yandex';
}
