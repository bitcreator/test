<?php

declare(strict_types=1);

namespace App\ValueObject;

use Webmozart\Assert\Assert;

class Triangle implements CalculableInterface
{
    public function __construct(private readonly int $a, private readonly int $b, private readonly int $c)
    {
        Assert::greaterThan($this->a, 0, 'Triangle "a" value must be greater then zero.');
        Assert::greaterThan($this->b, 0, 'Triangle "b" value must be greater then zero.');
        Assert::greaterThan($this->c, 0, 'Triangle "c" value must be greater then zero.');
        Assert::true($this->isValid(), 'Incorrect triangle data entered.');
    }

    public function getA(): int
    {
        return $this->a;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getC(): int
    {
        return $this->c;
    }

    public function getType(): GeometryType
    {
        return GeometryType::TRIANGLE;
    }

    public function calculateSurface(): float
    {
        $s = $this->calculateDiameter() / 2;

        return sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
    }

    public function calculateDiameter(): float
    {
        return $this->a + $this->b + $this->c;
    }

    public function isValid(): bool
    {
        return ($this->a + $this->b > $this->c) && ($this->a + $this->c > $this->b) && ($this->b + $this->c > $this->a);
    }
}
