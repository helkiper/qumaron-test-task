<?php

namespace App\Action;

use App\DataPersister\DataPersister;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Util\JsonFile;

class CreateAction extends Action
{
    public function run(array $params = [])
    {
        $orderSerializer = new OrderSerializer(); //todo inject
        $order = new Order();
        $orderSerializer->deserialize($order, JsonFile::read($params[0] ?? ''));

        $dataPersisterClass = Configuration::DATA_PERSISTER;
        /** @var DataPersister $dataPersister */
        $dataPersister = new $dataPersisterClass();
        $dataPersister->store($order, Order::class);

        echo 'Order stored successfully';
    }
}
