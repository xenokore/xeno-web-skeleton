<?php

return [
    [
        'output_dir'              => __DIR__ . '/../logs',
        'use_debug_log'           => (bool) \getenv('APP_LOG_DEBUG'),
        'use_fingers_crossed_log' => (bool) \getenv('APP_LOG_FINGERS_CROSSED'),
    ]
];
