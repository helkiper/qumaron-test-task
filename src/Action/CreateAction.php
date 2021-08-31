<?php

namespace App\Action;

use App\DataPersister\DataPersister;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Util\JsonFile;
use Exception;

class CreateAction implements Action
{
    /**
     * @var OrderSerializer
     */
    private OrderSerializer $serializer;

    /**
     * @var DataPersister
     */
    private $dataPersister;

    /**
     * @param OrderSerializer $serializer
     */
    public function __construct(OrderSerializer $serializer)
    {
        $this->serializer = $serializer;
        $this->dataPersister = Container::get(Configuration::DATA_PERSISTER);
    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function run(array $params = []): void
    {
        $order = new Order();
        $this->serializer->deserialize($order, JsonFile::read(
            isset($params[0]) ? Configuration::UPLOAD_DIR . '/' . $params[0] : ''
        ));

        $this->dataPersister->store($order, 'Order');

        echo 'Order stored successfully';
    }
}
