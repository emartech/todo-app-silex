<?php

function setRouting(Silex\Application $app)
{
  $app->get('/list', function() use ($app)
  {
    $html = '';
    $todos = $app['db']->fetchAll('SELECT * FROM todo_lista');
    foreach($todos as $todo)
    {
      $html.=$todo['title'];
    }
    return $html;
  });

  $app->delete('/api/todo/{id}', function($id) use ($app)
  {
    $sql = 'DELETE FROM todo_lista WHERE id=?';
    $app['db']->executeQuery($sql, array($id));
    return 'success';
  });
}
