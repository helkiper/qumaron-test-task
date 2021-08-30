<?php

namespace App\Action;

use App\DataPersister\DataPersister;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Util\JsonFile;

class CreateAction extends Action
{
    private OrderSerializer $serializer;

    public function __construct(OrderSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function run(array $params = [])
    {
        $order = new Order();
        $this->serializer->deserialize($order, JsonFile::read($params[0] ?? ''));

        /** @var DataPersister $dataPersister */
        $dataPersister = Container::get(Configuration::DATA_PERSISTER);
        $dataPersister->store($order, Order::class);

        echo 'Order stored successfully';
    }
}
