<?php

use Xenokore\App\Doctrine\DoctrineConfig;
use Psr\Container\ContainerInterface;

// Uncomment the following line if you wish to disable doctrine
// return [];

// Return the Doctrine container definitions
return [

    DoctrineConfig::class => DI\create()->constructor(__DIR__ . '/../../config/doctrine.config.php'),

    \Doctrine\DBAL\Configuration::class => DI\create(),

    \Doctrine\DBAL\Connection::class => function (ContainerInterface $container, \Doctrine\DBAL\Configuration $dbal_config) {
        return \Doctrine\DBAL\DriverManager::getConnection($container->get(DoctrineConfig::class)['connection_config'], $dbal_config);
    },

    \Doctrine\ORM\Configuration::class => function (ContainerInterface $container){
        $doctrine_config = $container->get(DoctrineConfig::class);
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

    \Doctrine\ORM\EntityManager::class => function (\Doctrine\DBAL\Connection $dbal_conn, \Doctrine\ORM\Configuration $orm_config){
        $em = \Doctrine\ORM\EntityManager::create($dbal_conn, $orm_config);
        $em->getConfiguration()->addEntityNamespace('App', '\\App\\Entity');
        return $em;
    },

    \Doctrine\Migrations\DependencyFactory::class => function(ContainerInterface $container, \Doctrine\DBAL\Configuration $dbal_config, \Doctrine\ORM\EntityManager $em) {
        return Doctrine\Migrations\DependencyFactory::fromEntityManager(
            new \Doctrine\Migrations\Configuration\Migration\ConfigurationArray($container->get(DoctrineConfig::class)['migration_config']),
            new \Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager($em)
        );
    }
];
