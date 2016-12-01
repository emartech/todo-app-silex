<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApiController
{
  protected $em;
  protected $request;

  public function __construct($request, $em)
  {
    $this->em = $em;
    $this->request = $request;
  }

  public function deleteTodo($id)
  {
    $todo = $this->em->find('Entities\TodoList', $id);
    
    if($todo){
      $this->em->remove($todo);
      $this->em->flush();
    }
    
    return 'success';
  }

  public function insertTodo()
  {
    $todo = new Entities\TodoList();
    $todo->setTitle($this->request->get('title'));
    $this->em->persist($todo);
    $this->em->flush();

    return 'success';
  }
}
