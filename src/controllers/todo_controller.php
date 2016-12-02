<?php

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Validator\Constraints as Assert;

class TodoController
{
  protected $em;
  protected $request;
  protected $formFactory;
  protected $twig;

  public function __construct($request, $em, $formFactory, $twig)
  {
    $this->em = $em;
    $this->request = $request;
    $this->formFactory = $formFactory;
    $this->twig = $twig;
  }

  private function generateForm()
  {
    $data = array(
      'title' => ''
    );

    return $this->formFactory->createBuilder(FormType::class, $data)
      ->add('title', TextType::class, array(
        'constraints' => array(new Assert\Length(array('min' => 2)))
      ))
      ->add('save', SubmitType::class, array('label' => 'add todo'))
      ->getForm();
  }

  public function generateIndexHtml()
  {
    return $this->renderTodos($this->generateForm()->createView(), $this->listTodos());
  }

  public function renderTodos($form, $todos)
  {
    return $this->twig->render('index.twig', array(
      'form' => $form,
      'todos' => $todos
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
