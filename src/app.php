<?php
require __DIR__ .'/app.routing.php';
require __DIR__ .'/app.services.php';

class Application extends Silex\Application {
  public function __construct(){
    parent::__construct();
    setRouting($this);
    registerServices($this);
  }
}