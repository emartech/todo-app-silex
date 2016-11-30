<?php

class TodoController
{
  protected $db;
  protected $request;

  public function __construct($request, $db)
  {
    $this->db = $db;
    $this->request = $request;
  }

  public function listTodos()
  {
    $html = '';
    $todos = $this->db->fetchAll('SELECT * FROM todo_list');
    foreach($todos as $todo)
    {
      $html.=$todo['title'];
    }
    return $html;
  }

  public function deleteTodo($id)
  {
    $sql = 'DELETE FROM todo_list WHERE id=?';
    $this->db->executeQuery($sql, array($id));
    return 'success';
  }

  public function insertTodo()
  {
    $sql = 'INSERT INTO todo_list (title, completed) VALUES (?, false)';
    $title = $this->request->get('title');

    $this->db->executeQuery($sql, array($title));
    return 'Success';
  }
}
