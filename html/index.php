<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once 'register.php';
require_once 'routing.php';

$app = new Silex\Application();

registerDb($app);
setRouting($app);

$app->run();
