<?php

declare(strict_types=1);

namespace CleanStructure\UserManagement\Application\Command;

use CleanStructure\UserManagement\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class UserCreateCommand
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * Сохранение в БД нового пользователя
     */
    public function create(string $username): UuidInterface
    {
        $user = new User(Uuid::uuid7(), $username);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user->id;
    }
}
