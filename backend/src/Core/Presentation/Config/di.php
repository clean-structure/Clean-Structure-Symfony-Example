<?php

declare(strict_types=1);

use CleanStructure\Core\Domain\NormalizeInterface;
use CleanStructure\Core\Domain\TransactionInterface;
use CleanStructure\Core\Infrastructure\Illuminate\PostgresTransaction;
use CleanStructure\Core\Infrastructure\Symfony\SerializerDecorator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->set(SerializerDecorator::class)
        ->factory([SerializerDecorator::class, 'create']);

    $services
        ->set(NormalizeInterface::class)
        ->alias(NormalizeInterface::class, SerializerDecorator::class);

    $services->set(PostgresTransaction::class);
    $services->set(TransactionInterface::class)
        ->alias(TransactionInterface::class, PostgresTransaction::class);
};
