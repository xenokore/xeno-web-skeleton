<?php

/**
 * Public endpoint of the Xeno app.
 * Everything that does not exist in the public directory will be routed through here.
 */

require_once __DIR__ . '/../app/bootstrap.php';

/** @var Slim\App */
$router = $app->getSlimRouter();

// Add middlewares to Slim router
foreach ((include __DIR__ . '/../app/middlewares.php') as $middleware_class) {
    $router->add(
        // Get from container so we can autowire dependencies
        $container->get($middleware_class)
    );
}

// Setup routes
include __DIR__ . '/../app/routes.php';

// Execute router
$router->run();
