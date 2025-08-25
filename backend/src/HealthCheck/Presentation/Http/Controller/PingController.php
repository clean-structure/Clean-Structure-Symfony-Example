<?php

declare(strict_types=1);

namespace Lk2\HealthCheck\Presentation\Http\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class PingController
{
    #[Route('/ping')]
    public function number(): Response
    {
        return new Response('pong');
    }
}
