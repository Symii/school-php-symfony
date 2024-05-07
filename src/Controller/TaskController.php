<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\Type\TaskType;



class TaskController extends AbstractController
{
    #[Route('/task', name: 'task')]
    public function new(): Response
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTimeImmutable('tomorrow'));

        $form = $this->createForm(TaskType::class, $task);

        
        return $this->render('task/task-form.html.twig', ['form' => $form]);
    }

    
}