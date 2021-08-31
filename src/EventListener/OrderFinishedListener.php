<?php

namespace App\EventListener;

use App\Entity\Car;
use App\Entity\Characteristic;
use App\Entity\Order;
use App\Event\Event;
use App\Event\OrderChangeStateEvent;
use App\Main\Configuration;
use App\Service\Mailer;

class OrderFinishedListener implements EventListener
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handleEvent(Event $event)
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
