<?php

declare(strict_types=1);

use App\Settings\Settings;
use App\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Psr\Log\LogLevel;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => LogLevel::DEBUG,
                ],
            ]);
        }
    ]);
};
