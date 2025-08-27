<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Filesystem\Filesystem;

require dirname(__DIR__) . '/../vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) { // @phpstan-ignore-line
    new Dotenv()->bootEnv(dirname(__DIR__) . '/../.env');
}

new Filesystem()->remove([__DIR__ . '/../../var/cache/test']);

if ($_SERVER['APP_DEBUG']) { // @phpstan-ignore-line
    umask(0000);
}
