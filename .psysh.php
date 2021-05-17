<?php
return [
    'commands' => [
        new \Psy\Command\ParseCommand,
    ],

    'defaultIncludes' => [
        __DIR__ . '/app/bootstrap.psysh.php'
    ],

    // 'startupMessage' => 'Xeno App REPL' . PHP_EOL,

    // 'prompt' => 'cf> '
];
