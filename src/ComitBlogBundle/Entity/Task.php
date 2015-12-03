<?php

namespace ComitBlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Task
{
    /**
     * @var
     * @Assert\NotBlank()
     */
    public $task;

    /**
     * @var
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;



    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }



}
