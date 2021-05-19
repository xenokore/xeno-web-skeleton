<?php

use Symfony\Component\Dotenv\Dotenv;

// Load composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env file if environment vars are not loaded
if(\getenv('APP_ENV') === false){
    $env = new Dotenv();
    $env->loadEnv(__DIR__ . '/../.env');
}

// Create logger
$logger = new \Xenokore\Logger\Logger(
    include __DIR__ . '/../config/logger.config.php'
);

// Create app
$app = new \Xenokore\App\App(
    include __DIR__ . '/../config/app.config.php',
    $logger
);

// Setup container
$container = $app->getContainer();
