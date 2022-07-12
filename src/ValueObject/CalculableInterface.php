<?php

declare(strict_types=1);

namespace App\ValueObject;

interface CalculableInterface
{
    public function calculateSurface(): float;

    public function calculateDiameter(): float;
}
