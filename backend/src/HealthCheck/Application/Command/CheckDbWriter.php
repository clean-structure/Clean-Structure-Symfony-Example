<?php

declare(strict_types=1);

namespace CleanStructure\HealthCheck\Application\Command;

use CleanStructure\Core\Domain\NormalizeInterface;
use CleanStructure\HealthCheck\Application\Dto\HealthCheck;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CheckDbWriter
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NormalizeInterface $serializer
    ) {
    }

    /**
     * Создаем временную таблицу
     */
    public function createTable(): void
    {
        $this->entityManager->getConnection()->executeQuery(
            'CREATE TEMPORARY TABLE health_check(dummy_column VARCHAR(255));'
        );
    }

    /**
     * Проверяем вставку записи в таблицу
     */
    public function insertValue(HealthCheck $testValue): bool
    {
        /** @var array<mixed> $binds */
        $binds = $this->serializer->normalize($testValue);

        return (bool)$this->entityManager->getConnection()->executeQuery(
            'INSERT INTO health_check VALUES (:dummy_column)',
            $binds
        )->rowCount();
    }

    /**
     * Проверяем обновление записи в таблице
     */
    public function updateValue(string $newValue, string $oldValue): int
    {
        return $this->entityManager->getConnection()->executeQuery(
            'UPDATE health_check SET dummy_column = :newValue where dummy_column = :oldValue',
            [
                'newValue' => $newValue,
                'oldValue' => $oldValue,
            ]
        )->rowCount();
    }

    /**
     * Проверяем удаление записи из таблицы
     */
    public function deleteValue(string $value): int
    {
        return $this->entityManager->getConnection()->executeQuery(
            'DELETE FROM health_check WHERE dummy_column = :value',
            ['value' => $value]
        )->rowCount();
    }
}
