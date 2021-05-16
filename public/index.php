<?php

/**
 * Public endpoint of the Xeno app.
 * Everything that does not exist in the public directory will be routed through here.
 */

require_once __DIR__ . '/../app/bootstrap.php';

$router = $app->getSlimRouter();

include __DIR__ . '/../app/routes.php';

$router->run();
