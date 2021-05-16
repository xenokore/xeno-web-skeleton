<?php

use function DI\autowire;
use function DI\create;

use App\Twig\TwigProvider;
use \Xenokore\App\Twig\TwigProviderInterface;

return [

    // Custom TwigProvider
    TwigProviderInterface::class => autowire(TwigProvider::class),
];
