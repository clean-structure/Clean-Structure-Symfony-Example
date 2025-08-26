<?php

declare(strict_types=1);

use CleanStructure\WelcomePage\Presentation\Http\Controller\WelcomeController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(WelcomeController::class);
};
