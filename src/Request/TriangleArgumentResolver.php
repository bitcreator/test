<?php

declare(strict_types=1);

namespace App\Request;

use App\ValueObject\Triangle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class TriangleArgumentResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return Triangle::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        yield new Triangle(
            $request->attributes->getInt('a'),
            $request->attributes->getInt('b'),
            $request->attributes->getInt('c')
        );
    }
}
