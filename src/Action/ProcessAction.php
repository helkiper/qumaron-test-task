<?php

namespace App\Action;

use App\DataPersister\DataPersister;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Service\OrderManager;
use App\Util\JsonFile;

class ProcessAction extends Action
{
    private OrderSerializer $serializer;
    private OrderManager $manager;
    private $dataPersister;

    public function __construct(OrderSerializer $serializer, OrderManager $manager)
    {
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->dataPersister = Container::get(Configuration::DATA_PERSISTER);
    }

    public function run(array $params = [])
    {
        $order = new Order();
        $this->serializer->deserialize($order, JsonFile::read(
            isset($params[1]) ? Configuration::DB_DIR . '/Order' . $params[1] : ''
        )); //todo extract to separate class hierarchy

        $this->manager->process($order, $params[0], $order::STAGE_FINISH);

        $this->dataPersister->store($order, 'Order');

        echo 'Order processed successfully';
    }
}
