<?php

require_once 'controllers/todo_controller.php';

function setRouting(Silex\Application $app)
{
  $app['controller.todo'] = function() use($app)
  {
    return new TodoController($app['db']);
  };

  $app->get('', "controller.todo:listTodos");

  $app->delete('/api/todo/{id}', "controller.todo:deleteTodo");

  $app->post('/api/todo', function() use($app) {
    $req = $app['request_stack']->getCurrentRequest();
    $sql = 'INSERT INTO todo_lista (title, completed) VALUES (?, false)';
    $title = $req->request->get('title');

    $app['db']->executeQuery($sql, array($title));
    return 'Success';
  });
}
