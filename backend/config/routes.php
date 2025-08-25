<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $configurator): void {
    $configurator->import(resource: __DIR__ . '/../src/**/Presentation/Http/Controller/*.php', type: 'attribute');
    $configurator->import(resource: __DIR__ . '/../src/**/Presentation/Config/routes.php');
};
