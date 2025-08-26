<?php

declare(strict_types=1);

use CleanStructure\HealthCheck\Application\Command\CheckDbWriter;
use CleanStructure\HealthCheck\Application\Query\CheckDbReader;
use CleanStructure\HealthCheck\Application\UseCase\DbHealthUseCase;
use CleanStructure\HealthCheck\Presentation\Http\Controller\HealthcheckController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(HealthcheckController::class);
    $services->set(DbHealthUseCase::class);
    $services->set(CheckDbReader::class);
    $services->set(CheckDbWriter::class);
};
