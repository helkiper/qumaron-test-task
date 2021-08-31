<?php

namespace App\EventListener;

use App\Event\Event;

interface EventListener
{
    /**
     * @param Event $event
     */
    public function handleEvent(Event $event): void;
}
