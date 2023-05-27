<?php 

namespace App\Event;

use App\Entity\Task;
use Symfony\Contracts\EventDispatcher\Event;

class TaskCreatedEvent extends Event {

    public const NAME = 'app.task.created';

    /**
     * Task
     */
    protected $subject;

    public function __construct(Task $task)
    {
        $this->subject = $task;
    }

    public function getSubject()
    {
        return $this->subject;
    }

}