<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Domain\Response;

final readonly class HealthCheckErrors
{
    public function __construct(
        public string $dbCheckMessage
    ) {
    }
}
