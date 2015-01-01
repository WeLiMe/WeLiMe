<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/vendor/autoload.php';

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/app/WeLiMe"), $isDevMode);

// Database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'dbname' => '3270_3277_3269_3312_3441',
    'user' => 'root',
    'password' => ''
);

// Getting the EntityManager
$entityManager = EntityManager::create($conn, $config);
