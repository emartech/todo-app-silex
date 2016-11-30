<?php
require_once 'bootstrap.php';

function registerDb(Silex\Application $app)
{
  global $dbParams;

  $app->register(new Silex\Provider\ServiceControllerServiceProvider());
  $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $dbParams
  ));

  $app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider,
  [
    'orm.proxies_dir' => 'cache',
    'orm.auto_generate_proxies' => true,
    'orm.em.options' => [
      'mappings' => [
        [
          'type' => 'yml',
          'namespace' => 'Entities',
          'path' => __DIR__ .'/../orm/mapping',
        ],
      ]
    ]
  ]);
  
}
