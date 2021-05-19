<?php

return [
    [
        'output_dir'              => __DIR__ . '/../logs',
        'use_debug_log'           => (bool) ($_ENV['APP_LOG_DEBUG'] ?? false),
        'use_fingers_crossed_log' => (bool) ($_ENV['APP_LOG_FINGERS_CROSSED'] ?? true),
    ]
];
