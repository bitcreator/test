<?php

declare(strict_types=1);

namespace App\ValueObject;

use Webmozart\Assert\Assert;

class Circle implements CalculableInterface
{
    public function __construct(private readonly int $radius)
    {
        Assert::greaterThan($this->radius, 0, 'Circle radius must be more than zero.');
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    public function getType(): GeometryType
    {
        return GeometryType::CIRCLE;
    }

    public function calculateSurface(): float
    {
        return M_PI * ($this->radius * $this->radius);
    }

    public function calculateDiameter(): float
    {
        return M_PI * $this->radius;
    }
}
