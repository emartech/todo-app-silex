<?php

class TodoController
{
  protected $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function listTodos()
  {
    $html = '';
    $todos = $this->db->fetchAll('SELECT * FROM todo_lista');
    foreach($todos as $todo)
    {
      $html.=$todo['title'];
    }
    return $html;
  }

  public function deleteTodo($id)
  {
    $sql = 'DELETE FROM todo_lista WHERE id=?';
    $this->db->executeQuery($sql, array($id));
    return 'success';
  }
}
