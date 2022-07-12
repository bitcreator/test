<?php

declare(strict_types=1);

namespace App\Controller;

use App\ValueObject\Circle;
use App\Traits\SerializerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CalculateCircleAction
{
    use SerializerTrait;

    #[Route(path: '/circle/{radius}', name: 'api_circle', methods: [Request::METHOD_GET])]
    public function __invoke(Circle $circle): JsonResponse
    {
        $responseData = $this->serializer->serialize($circle, 'json');

        return new JsonResponse(data: $responseData, json: true);
    }
}
