<?php

use function DI\create;
use function DI\get;
use function DI\autowire;
use function DI\factory;

use Psr\Container\ContainerInterface;

// Load the Doctrine config
$doctrine_config   = include __DIR__ . '/../../config/doctrine.config.php';

// Exclude Doctrine if disabled
if($doctrine_config['doctrine_enabled'] !== true){
    return [];
}

// Return the Doctrine container definitions
return [

    \Doctrine\DBAL\Configuration::class => create(),

    \Doctrine\DBAL\Connection::class => function (\Doctrine\DBAL\Configuration $dbal_config) use ($doctrine_config) {
        return \Doctrine\DBAL\DriverManager::getConnection($doctrine_config['connection_config'], $dbal_config);
    },

    \Doctrine\ORM\Configuration::class => function (ContainerInterface $container) use ($doctrine_config) {
        $orm_config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $doctrine_config['entity_dirs'],
            $doctrine_config['dev_mode'],
            $doctrine_config['proxy_dir'],
            $doctrine_config['metadata_cache'],
            $doctrine_config['use_simple_annotation_reader'],
        );
        // Add naming strategy
        if(isset($doctrine_config['orm_naming_strategy']) && \is_object($doctrine_config['orm_naming_strategy'])){
            $orm_config->setNamingStrategy($doctrine_config['orm_naming_strategy']);
        }
        return $orm_config;
    },

    \Doctrine\ORM\EntityManager::class => function (\Doctrine\DBAL\Connection $dbal_conn, \Doctrine\ORM\Configuration $orm_config/* , \Doctrine\Common\EventManager $evm */) use ($doctrine_config) {
        $em = \Doctrine\ORM\EntityManager::create($dbal_conn, $orm_config/* , $evm */);
        $em->getConfiguration()->addEntityNamespace('App', '\\App\\Entity');
        return $em;
    },

    \Doctrine\Migrations\DependencyFactory::class => function(\Doctrine\DBAL\Configuration $dbal_config, \Doctrine\ORM\EntityManager $em) use ($doctrine_config)
    {
        return Doctrine\Migrations\DependencyFactory::fromEntityManager(
            new \Doctrine\Migrations\Configuration\Migration\ConfigurationArray($doctrine_config['migration_config']),
            new \Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager($em)
        );
    }
];
