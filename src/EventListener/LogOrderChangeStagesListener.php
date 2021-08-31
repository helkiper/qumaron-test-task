<?php

namespace App\EventListener;

use App\DependencyInjection\Container;
use App\Event\Event;
use App\Event\OrderChangeStateEvent;
use App\Logger\Logger;
use App\Main\Configuration;
use ReflectionException;

class LogOrderChangeStagesListener implements EventListener
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->logger = Container::get(Configuration::LOGGER);
    }

    /**
     * @param Event $event
     */
    public function handleEvent(Event $event): void
    {
        if (!$event instanceof OrderChangeStateEvent) {
            return;
        }

        $this->logger->info(sprintf(
            "Order #%d has changed stage '%s' state from '%s' to '%s'",
            $event->getOrder()->getId(),
            $event->getStage(),
            $event->getOldStages()[$event->getStage()],
            $event->getOrder()->getStages()[$event->getStage()]
        ));
    }
}
