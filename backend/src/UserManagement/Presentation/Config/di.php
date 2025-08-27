<?php

declare(strict_types=1);

use CleanStructure\UserManagement\Application\Command\UserCreateCommand;
use CleanStructure\UserManagement\Application\UseCase\UserManagerUseCase;
use CleanStructure\UserManagement\Presentation\Console\CreateUser;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(CreateUser::class);
    $services->set(UserManagerUseCase::class);
    $services->set(UserCreateCommand::class);
};
