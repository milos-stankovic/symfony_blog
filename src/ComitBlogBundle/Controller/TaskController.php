<?php
namespace ComitBlogBundle\Controller;

use ComitBlogBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ComitBlogBundle\Entity\Author;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @Route("/task/form")
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {
            return $this->redirectToRoute("home");
        }

        return $this->render('default/new.html.twig', array('form' => $form->createView()));
    }

    // using validator service
    public function authorAction()
    {
        $author = new Author();

        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if(count($errors) > 0) {
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }
        return new Response('The author is valid!');
    }

    /**
     * @return bool
     * Assert\True(message = "The password cannot match your first name")
     */
    public function isPasswordLegal()
    {
        return $this->firstName !== $this->password;
    }

    public function newwAction()
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

    }

}