<?php

namespace App\Twig;

use Psr\Container\ContainerInterface;

class TwigProvider extends \Xenokore\App\Twig\TwigProvider
{

    /**
     * The app container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Constructor for the TwigProvider.
     * Autowires all class parameters.
     * This is useful to expand the globals of the TwigEnvironment
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addGlobals(): array
    {
        // Add globals here
        return [];
    }
}
