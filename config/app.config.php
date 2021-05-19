<?php

/**
 * App configuration file.
 * Should only contain static variables that do not change depending on environment.
 */

return [
    'src_dir'        => \realpath(__DIR__ . '/../src'),
    'container_dir'  => \realpath(__DIR__ . '/../app/container'),
    'views_dir'      => \realpath(__DIR__ . '/../views'),
    'controller_dir' => \realpath(__DIR__ . '/../controllers'),
    'cache_dir'      => \realpath(__DIR__ . '/../cache'),
    'vendor_dir'     => \realpath(__DIR__ . '/../vendor'),

    'load_vendor_components' => true,

    'slim_enabled' => true,
    'twig_enabled' => true,
];
