<?php

require_once 'controllers/todo_controller.php';

function setRouting(Silex\Application $app)
{
  $app['controller.todo'] = function() use($app)
  {
    return new TodoController
    (
      $app['request_stack']->getCurrentRequest(),
      $app['db']
    );
  };

  $app->get('', "controller.todo:listTodos");

  $app->delete('/api/todo/{id}', "controller.todo:deleteTodo");

  $app->post('/api/todo', "controller.todo:insertTodo");
}
