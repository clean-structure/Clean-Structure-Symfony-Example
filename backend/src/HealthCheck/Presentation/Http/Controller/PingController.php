<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Presentation\Http\Controller;

use Nelmio\ApiDocBundle\Attribute\Areas;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

final readonly class PingController
{
    #[Route('/ping', name: 'ping', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'ping',
        content: new OA\MediaType(mediaType: 'text/html', schema: new OA\Schema(type:'string'), example: 'pong')
    )]
    #[Areas(['internal'])]
    public function number(): Response
    {
        return new Response('pong');
    }
}
