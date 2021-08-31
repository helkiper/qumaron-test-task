<?php

namespace App\EventListener;

use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Event\Event;
use App\Event\OrderChangeStateEvent;
use App\Mailer\Mailer;
use App\Main\Configuration;
use ReflectionException;

class OrderFinishedListener implements EventListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->mailer = Container::get(Configuration::MAILER);
    }

    /**
     * @param Event $event
     */
    public function handleEvent(Event $event): void
    {
        if (!$event instanceof OrderChangeStateEvent) {
            return;
        }

        $order = $event->getOrder();
        foreach ($order->getStages() as $stage) {
            if ($stage != Order::STAGE_FINISH) {
                return;
            }
        }

        $this->mailer->send(
            $order->getCar()->printCharacteristics(),
            Configuration::ADMIN_EMAIL,
            $order->getClient()->getEmail(),
            'Order is ready'
        );
    }


}
