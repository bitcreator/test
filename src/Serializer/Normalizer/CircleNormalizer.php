<?php

declare(strict_types=1);

namespace App\Serializer\Normalizer;

use App\ValueObject\Circle;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CircleNormalizer implements NormalizerInterface
{
    /** @param Circle $object */
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return [
            'type'          => $object->getType()->value,
            'radius'        => $object->getRadius(),
            'surface'       => $object->calculateSurface(),
            'circumference' => $object->calculateDiameter(),
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof Circle;
    }
}
