<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Webmozart\Assert\InvalidArgumentException;

#[AsEventListener(event: 'kernel.exception')]
class ErrorHandler
{
    public function __invoke(ExceptionEvent $event): void
    {
        if ($event->getRequest()->getContentType() === 'json') {
            $exception = $event->getThrowable();
            $errorData = [
                'error'   => $this->getHttpError($exception),
                'message' => $exception->getMessage(),
            ];

            $event->setResponse(new JsonResponse(data: $errorData, status: $errorData['error']));
        }
    }

    private function getHttpError(\Throwable $exception): int
    {
        return $exception instanceof InvalidArgumentException
            ? Response::HTTP_BAD_REQUEST
            : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
