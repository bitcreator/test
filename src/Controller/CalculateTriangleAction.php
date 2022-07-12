<?php

declare(strict_types=1);

namespace App\Controller;

use App\ValueObject\Triangle;
use App\Traits\SerializerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CalculateTriangleAction
{
    use SerializerTrait;

    #[Route(path: '/triangle/{a}/{b}/{c}', name: 'api_triangle', methods: [Request::METHOD_GET])]
    public function __invoke(Triangle $triangle): JsonResponse
    {
        $responseData = $this->serializer->serialize($triangle, 'json');

        return new JsonResponse(data: $responseData, json: true);
    }
}
