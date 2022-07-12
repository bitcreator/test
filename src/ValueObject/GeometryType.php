<?php

declare(strict_types=1);

namespace App\ValueObject;

enum GeometryType: string
{
    case TRIANGLE = 'triangle';
    case CIRCLE = 'circle';
}
