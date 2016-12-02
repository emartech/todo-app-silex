<?php
require_once '../vendor/autoload.php';
require_once '../src/app.php';

$app = new Application();
$app['debug'] = true;

$app->run();
