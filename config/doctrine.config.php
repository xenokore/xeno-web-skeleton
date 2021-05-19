<?php

$app_config = include 'app.config.php';

return [

    'doctrine_enabled' => true,

    'connection_config' => [
        'driver'   => $_ENV['APP_DB_DRIVER'],
        'user'     => $_ENV['APP_DB_USER'],
        'password' => $_ENV['APP_DB_PASS'],
        'dbname'   => $_ENV['APP_DB_NAME'],
    ],

    'entity_dirs' => [
        __DIR__ . '/../src/Entity'
    ],

    'dev_mode' => (bool) ($_ENV['APP_DOCTRINE_DEV_MODE'] ?? false),

    'metadata_cache' => $_ENV['APP_ENV'] === 'dev' ?
        // Dev cache
        new \Doctrine\Common\Cache\ArrayCache() :
        // Production cache
        // NOTE: This should be changed to something like Redis
        new \Doctrine\Common\Cache\FilesystemCache(
            $app_config['cache_dir'] . '/doctrine/metadata'
        ),

    'proxy_dir' => $app_config['cache_dir'] . '/doctrine/proxy',

    'use_simple_annotation_reader' => true,

    'orm_naming_strategy' => new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy(CASE_LOWER),

    'migration_config' => [
        'table_storage' => [
            'table_name' => '_migrations',
            'version_column_name' => 'version',
            'version_column_length' => 1024,
            'executed_at_column_name' => 'executed_at',
            'execution_time_column_name' => 'execution_time',
        ],
        'migrations_paths' => [
            'App\Migrations' => __DIR__ . '/../migrations',
        ],
        'all_or_nothing' => true,
        'check_database_platform' => true,
        'organize_migrations' => 'none',
        'connection' => null,
        'em' => null,
    ],

    'migration_commands' => [
        \Doctrine\Migrations\Tools\Console\Command\CurrentCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\DiffCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\ExecuteCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\GenerateCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\LatestCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\ListCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\MigrateCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\RollupCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\StatusCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand::class,
        \Doctrine\Migrations\Tools\Console\Command\VersionCommand::class,
    ],
];
