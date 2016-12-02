<?php
require 'src/controllers/todo_controller.php';

class DummyTwigClass {
    public function render($template, $params){ }
}

class TodoListControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderTodos()
    {
        $twigMock = $this->createMock(DummyTwigClass::class);
        $controller = new TodoController(null, null, null, $twigMock);

        $form = 'FORMCLASS';
        $todos = [];

        $twigMock->expects($this->once())
                 ->method('render')
                 ->with('index.twig', [
                     'form' => $form,
                     'todos' => $todos
                ]);

        $controller->renderTodos($form, $todos);

    }
}