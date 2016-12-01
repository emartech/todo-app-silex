<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class TodoController
{
  protected $db;
  protected $request;
  protected $formBuilderFactory;
  protected $render;

  public function __construct($request, $db, $formBuilderFactory, $render)
  {
    $this->db = $db;
    $this->request = $request;
    $this->formBuilderFactory = $formBuilderFactory;
    $this->render = $render;
  }

  private function generateForm()
  {
    $data = array(
      'title' => ''
    );

    $factory = $this->formBuilderFactory;

    return $factory($data)
      ->add('title', TextType::class)
      ->add('save', SubmitType::class, array('label' => 'add todo'))
      ->getForm();
  }

  public function renderTodos()
  {
    return ($this->render)('index.twig', array(
      'form' => $this->generateForm()->createView(),
      'todos' => $this->listTodos()
    ));
  }

  private function listTodos()
  {
    return $this->db->fetchAll('SELECT * FROM todo_list');
  }

  public function insertTodo()
  {
    $form = $this->generateForm();
    $form->handleRequest($this->request);

    if ($form->isValid())
    {
      $data = $form->getData();
      return 'Success';
    }
    return 'Failed';
  }
}
