<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\CalculableInterface;

class GeometryCalculator
{
    public function sumOfSurfaces(CalculableInterface $first, CalculableInterface $second): float
    {
        return $first->calculateSurface() + $second->calculateSurface();
    }

    public function sumOfDiameters(CalculableInterface $first, CalculableInterface $second): float
    {
        return $first->calculateDiameter() + $second->calculateDiameter();
    }
}
