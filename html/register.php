<?php
function registerDb(Silex\Application $app)
{
  $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
      'driver' => 'pdo_mysql',
      'host' => 'db',
      'dbname' => 'todo',
      'user' => 'app',
      'password' => 'password',
      'charset' => 'utf8'
    )
  ));
}
