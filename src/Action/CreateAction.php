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

    /**
     * @var DataPersister
     */
    private $dataPersister;

    public function __construct(OrderSerializer $serializer)
    {
        $this->serializer = $serializer;
        $this->dataPersister = Container::get(Configuration::DATA_PERSISTER);
    }

    public function run(array $params = [])
    {
        $order = new Order();
        $this->serializer->deserialize($order, JsonFile::read(
            isset($params[0]) ? Configuration::UPLOAD_DIR . '/' . $params[0] : ''
        )); //todo extract to separate class hierarchy

        $this->dataPersister->store($order, 'Order');

        echo 'Order stored successfully';
    }
}
