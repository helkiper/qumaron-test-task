<?php

namespace App\Service;

use App\DataStructure\ArrayCollection;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Event\OrderChangeStateEvent;
use App\EventListener\EventListener;

class OrderManager
{
    private array $eventListeners;

    public function __construct()
    {
        $this->eventListeners = Container::getInstancesOf(EventListener::class); //todo other places make the same
    }

    public function process(Order $order, string $stage, string $newState)
    {
        $oldStages = $newStages = $order->getStages();
        if ($newStages[$stage] == $newState) {
            return;
        }

        $newStages[$stage] = $newState;
        $order->setStages($newStages);

        $this->dispatchEvent($order, $oldStages, $stage);
    }

    private function dispatchEvent(Order $order, array $oldStages, string $stage)
    {
        $event = new OrderChangeStateEvent($order, $stage, $oldStages);

        /** @var EventListener $eventListener */
        foreach ($this->eventListeners as $eventListener) {
            $eventListener->handleEvent($event);
        }
    }
}
