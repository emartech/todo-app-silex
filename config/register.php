<?php
require_once 'bootstrap.php';

function registerDb(Silex\Application $app)
{
  global $dbParams;

  $app->register(new Silex\Provider\ServiceControllerServiceProvider);

  $app->register(new Silex\Provider\DoctrineServiceProvider, array(
    'db.options' => $dbParams
  ));

  $app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider,
  [
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

  $app->register(new Silex\Provider\LocaleServiceProvider());
  $app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
  ));

  $app->register(new Silex\Provider\TwigServiceProvider, array(
    'twig.path' => __DIR__ .'/../html/views',
  ));

  $app->register(new Silex\Provider\FormServiceProvider);
}
