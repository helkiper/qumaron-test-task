<?php

namespace App\Action;

use App\DataProvider\DataProvider;
use App\Entity\Order;
use App\Main\Configuration;

class ListAction extends Action
{
    public function run(array $params = [])
    {
        /** @var DataProvider $dataProvider */
        $dataProvider = new (Configuration::DATA_PROVIDER)();
        $orders = $dataProvider->findAll(Order::class);

        /** @var Order $order */
        foreach ($orders as $order) {
            $info = sprintf(
                '#%d\t%s\t%s\t%s\n',
                $order->getId(),
                $order->getClient()->getName(),
                $order->getClient()->getEmail(),
                $order->getCar()->getModel()
            );

            echo $info;
        }
    }
}
