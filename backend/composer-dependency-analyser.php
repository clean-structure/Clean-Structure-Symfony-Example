<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return new Configuration()
    ->addPathsToScan(['config'], false)
    ->ignoreErrorsOnPackages(
        [
            'symfony/console',
            'symfony/flex',
            'symfony/routing',
            'symfony/runtime',
            'symfony/yaml',
        ],
        [ErrorType::UNUSED_DEPENDENCY]
    )
    ->ignoreErrorsOnPackage(
        'symfony/dotenv',
        [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV]
    );
