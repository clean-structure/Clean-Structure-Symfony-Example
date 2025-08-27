<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return new Configuration()
    ->addPathsToScan(['config'], false)
    ->addPathToExclude('tests/CodeSniffer/Sniffs/Commenting/FunctionCommentSniff.php')
    ->addPathToExclude('config/packages/monolog.php')
    ->ignoreErrorsOnPackages(
        [
            'symfony/asset',
            'symfony/flex',
            'symfony/runtime',
            'symfony/yaml',
            'doctrine/dbal',
            'symfony/config',
            'symfony/property-access',
            'ramsey/uuid-doctrine',
        ],
        [ErrorType::UNUSED_DEPENDENCY]
    )
    ->ignoreErrorsOnPackages([
            'symfony/dotenv',
            'symfony/filesystem',
        ],
        [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV]
    )
    ->ignoreErrorsOnPackages([
            'symfony/web-profiler-bundle',
            'dama/doctrine-test-bundle',
        ],
        [ErrorType::DEV_DEPENDENCY_IN_PROD]
    );
