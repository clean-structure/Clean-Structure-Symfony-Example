<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $configurator->import(resource: __DIR__ . '/../src/**/Presentation/Config/di.php');

    if ($configurator->env() !== null) {
        $configurator->import(resource: __DIR__ . "/../src/**/Presentation/Config/di_{$configurator->env()}.php");
    }
};
