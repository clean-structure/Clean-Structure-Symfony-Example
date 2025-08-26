<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Http\Controller;

use CleanStructure\HealthCheck\Application\UseCase\DbHealthUseCase;
use CleanStructure\HealthCheck\Domain\Response\HealthCheckErrors;
use Nelmio\ApiDocBundle\Attribute\Areas;
use Nelmio\ApiDocBundle\Attribute\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Throwable;

final readonly class HealthcheckController
{
    #[Route('/healthcheck', name: 'healthcheck', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Health check status',
        content: new OA\MediaType(mediaType: 'text/html', schema: new OA\Schema(type:'string'), example: 'ok')
    )]
    #[OA\Response(
        response: 500,
        description: 'List of errors',
        content: new OA\JsonContent(ref: new Model(type: HealthCheckErrors::class))
    )]
    #[Areas(['internal'])]
    public function check(DbHealthUseCase $dbHealthUseCase): Response
    {
        try {
            $dbHealthUseCase->check();
        } catch (Throwable $exception) {
            return new JsonResponse(new HealthCheckErrors($exception->getMessage()));
        }

        return new Response('ok');
    }
}
