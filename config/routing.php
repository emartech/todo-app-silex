<?php

use Symfony\Component\Form\Extension\Core\Type\FormType;
require_once 'controllers/todo_controller.php';
require_once 'controllers/api_controller.php';

function setRouting(Silex\Application $app)
{
  $app['controller.todo'] = function() use($app)
  {
    return new TodoController
    (
      $app['request_stack']->getCurrentRequest(),
      $app['orm.em'],
      function($data) use ($app) {
        return $app['form.factory']->createBuilder(FormType::class, $data);
      },
      function ($template, $scope) use ($app) {
        return $app['twig']->render($template, $scope);
      }
    );
  };
  
  $app->get('', "controller.todo:renderTodos");
  $app->post('', "controller.todo:insertTodo");

  $app['controller.api'] = function() use($app)
  {
    return new ApiController
    (
      $app['request_stack']->getCurrentRequest(),
      $app['orm.em']
    );
  };

  $app->delete('/api/todo/{id}', "controller.api:deleteTodo");
  $app->post('/api/todo', "controller.api:insertTodo");
}
