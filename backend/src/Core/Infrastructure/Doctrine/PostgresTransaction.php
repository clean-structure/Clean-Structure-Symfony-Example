<?php

declare(strict_types=1);

namespace CleanStructure\Core\Infrastructure\Doctrine;

use CleanStructure\Core\Domain\TransactionInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class PostgresTransaction implements TransactionInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /** @inheritdoc */
    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    /** @inheritdoc */
    public function commit(): void
    {
        $this->entityManager->commit();
    }

    /** @inheritdoc */
    public function rollBack(): void
    {
        $this->entityManager->rollback();
    }
}
