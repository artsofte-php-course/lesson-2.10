<?php

namespace App\Listener;

use App\Event\TaskCreatedEvent;
use App\Service\TelegramNotifier;

class TaskCreatedListener {

    protected $telegram;


    public function __construct(TelegramNotifier $telegram)
    {
        $this->telegram = $telegram;
    }

    public function __invoke(TaskCreatedEvent $event) 
    {
        $task = $event->getSubject();

        $this->telegram->notify(
            sprintf('New task created %s', $task->getName())
        );  
    }

}