<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApiController
{
  protected $db;
  protected $request;

  public function __construct($request, $db)
  {
    $this->db = $db;
    $this->request = $request;
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
