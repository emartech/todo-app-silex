<?php
require_once '../vendor/autoload.php';
require_once '../config/register.php';
require_once '../config/routing.php';

$app = new Silex\Application();
$app['debug'] = true;

registerDb($app);
setRouting($app);

$app->run();
