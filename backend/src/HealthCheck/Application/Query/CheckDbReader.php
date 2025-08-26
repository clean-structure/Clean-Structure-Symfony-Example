<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Application\Query;

use CleanStructure\Core\Domain\NormalizeInterface;
use CleanStructure\HealthCheck\Application\Dto\HealthCheck;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CheckDbReader
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NormalizeInterface $serializer
    ) {
    }

    /**
     * Получить все записи
     *
     * @return list<HealthCheck>
     */
    public function selectAllValues(): array
    {
        $data = $this->entityManager->getConnection()->executeQuery('SELECT dummy_column FROM health_check');
        return $this->serializer->denormalizeArray($data->fetchAllAssociative(), HealthCheck::class, 'array');
    }
}
