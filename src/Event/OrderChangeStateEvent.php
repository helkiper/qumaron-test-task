<?php

namespace App\Event;

use App\Entity\Order;

class OrderChangeStateEvent implements Event
{
    /**
     * @var Order
     */
    private Order $order;

    /**
     * @var string
     */
    private string $stage;

    /**
     * @var array
     */
    private array $oldStages;

    /**
     * @param Order $order
     * @param string $stage
     * @param array $oldStages
     */
    public function __construct(Order $order, string $stage, array $oldStages)
    {
        $this->order = $order;
        $this->stage = $stage;
        $this->oldStages = $oldStages;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getStage(): string
    {
        return $this->stage;
    }

    /**
     * @return array
     */
    public function getOldStages(): array
    {
        return $this->oldStages;
    }
}
