<?php
// bootstrap.php
require_once __DIR__ ."/../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;

// the connection configuration
$dbParams = array(
  'driver' => 'pdo_mysql',
  'host' => 'db',
  'dbname' => 'todo',
  'user' => 'app',
  'password' => 'password',
);

$paths = array(__DIR__ ."/../orm/mapping");
$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);