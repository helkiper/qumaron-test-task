<?php

namespace App\Action;

use App\DataProvider\DataProvider;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;

class ListAction implements Action
{
    /**
     * @var DataProvider
     */
    private $dataProvider;

    public function __construct()
    {
        $this->dataProvider = Container::get(Configuration::DATA_PROVIDER);
    }

    /**
     * @param array $params
     */
    public function run(array $params = []): void
    {
        $orders = $this->dataProvider->findAll(Order::class);

        /** @var Order $order */
        foreach ($orders as $order) {
            $info = sprintf(
                "#%d\t%s\t%s\t%s\n",
                $order->getId(),
                $order->getClient()->getName(),
                $order->getClient()->getEmail(),
                $order->getCar()->getModel()
            );

            echo $info;
        }
    }
}
