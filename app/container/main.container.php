<?php

use function DI\create;
use function DI\get;
use function DI\autowire;
use function DI\factory;

use App\Twig\TwigProvider;
use Xenokore\App\Twig\TwigProviderInterface;

use Xenokore\Logger\Logger;

return [

    // Custom TwigProvider
    TwigProviderInterface::class => autowire(TwigProvider::class),

    // Logger
    LoggerInterface::class => function () {
        return new Logger(include __DIR__ . '/../../config/logger.config.php');
    },
];
