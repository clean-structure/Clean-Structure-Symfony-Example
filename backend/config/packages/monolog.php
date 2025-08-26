<?php

declare(strict_types=1);

use Psr\Log\LogLevel;
use Symfony\Config\MonologConfig;

return static function (MonologConfig $monolog): void {
    $monolog->handler('file_log')
        ->type('rotating_file')
        ->maxFiles(1)
        ->path('%kernel.logs_dir%/%kernel.environment%.log')
        ->level(LogLevel::DEBUG);

    $monolog->handler('stderr')
        ->type('stream')
        ->path('php://stderr')
        ->formatter('monolog.formatter.json')
        ->level(LogLevel::ERROR);
};
