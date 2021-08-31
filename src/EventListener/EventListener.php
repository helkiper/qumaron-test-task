<?php

namespace App\EventListener;

use App\Event\Event;

interface EventListener
{
    public function handleEvent(Event $event);
}
