<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class TodoController
{
  protected $em;
  protected $request;
  protected $formBuilderFactory;
  protected $render;

  public function __construct($request, $em, $formBuilderFactory, $render)
  {
    $this->em = $em;
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
      ->add('title', TextType::class, array(
        'constraints' => array(new Assert\Length(array('min' => 2)))
      ))
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
    return $this->em->getRepository('Entities\TodoList')->findAll();
  }

  public function insertTodo()
  {
    $form = $this->generateForm();
    $form->handleRequest($this->request);

    if ($form->isValid())
    {
      $data = $form->getData();

      $todo = new Entities\TodoList;
      $todo->setTitle($data['title']);
      $this->em->persist($todo);
      $this->em->flush();

      return 'Success';
    }
    return 'Failed';
  }
}
