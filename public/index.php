<?php

/**
 * Public endpoint of the Xeno app.
 * Everything that does not exist in the public directory will be routed through here.
 */

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/router.php';

$router->run();
