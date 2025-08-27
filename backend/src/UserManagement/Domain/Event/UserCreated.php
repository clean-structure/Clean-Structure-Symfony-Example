<?php

declare(strict_types=1);

namespace CleanStructure\UserManagement\Domain\Event;

use Ramsey\Uuid\UuidInterface;

final readonly class UserCreated
{
    public function __construct(
        public UuidInterface $userId,
        public string $username
    ) {
    }
}
