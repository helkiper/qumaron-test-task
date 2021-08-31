<?php

namespace App\Action;

use App\DataPersister\DataPersister;
use App\DataProvider\DataProvider;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;
use App\Service\OrderManager;
use Exception;
use ReflectionException;

class ProcessAction implements Action
{
    /**
     * @var OrderManager
     */
    private OrderManager $manager;

    /**
     * @var DataPersister
     */
    private $dataPersister;

    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * @param OrderManager $manager
     * @throws ReflectionException
     */
    public function __construct(OrderManager $manager)
    {
        $this->manager = $manager;
        $this->dataPersister = Container::get(Configuration::DATA_PERSISTER);
        $this->dataProvider = Container::get(Configuration::DATA_PROVIDER);
    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function run(array $params = []): void
    {
        $order = $this->dataProvider->find(Order::class, $params[1]);

        $this->manager->process($order, $params[0], $order::STAGE_FINISH);

        $this->dataPersister->store($order, 'Order');

        echo 'Order processed successfully';
    }
}
