<?php

function setRouting(Silex\Application $app)
{
  $app->get('', function() use ($app)
  {
    $html = '';
    $todos = $app['db']->fetchAll('SELECT * FROM todo_lista');
    foreach($todos as $todo)
    {
      $html.=$todo['title'];
    }
    return $html;
  });
}
