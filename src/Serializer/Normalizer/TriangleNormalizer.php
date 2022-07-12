<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\ValueObject\Triangle;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TriangleNormalizer implements NormalizerInterface
{
    /** @param Triangle $object */
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return [
            'type'          => $object->getType()->value,
            'a'             => $object->getA(),
            'b'             => $object->getB(),
            'c'             => $object->getC(),
            'surface'       => $object->calculateSurface(),
            'circumference' => $object->calculateDiameter(),
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof Triangle;
    }
}
