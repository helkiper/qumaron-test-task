<?php

namespace App\Serializer;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Order;
use Exception;

class OrderSerializer implements Deserializer, Serializer
{
    /**
     * @var CarSerializer
     */
    private CarSerializer $carSerializer;

    /**
     * @var ClientSerializer
     */
    private ClientSerializer $clientSerializer;

    /**
     * @param CarSerializer $carSerializer
     * @param ClientSerializer $clientSerializer
     */
    public function __construct(CarSerializer $carSerializer, ClientSerializer $clientSerializer)
    {
        $this->carSerializer = $carSerializer;
        $this->clientSerializer = $clientSerializer;
    }

    /**
     * @param $entity
     * @return bool
     */
    public function support($entity): bool
    {
        return $entity instanceof Order;
    }

    /**
     * @param Order $entity
     * @param array $data
     * @throws Exception
     */
    public function deserialize($entity, array $data)
    {
        if (isset($data['id'])) {
            $entity->setId($data['id']);
        }

        $stages = [];
        foreach ($data['stages'] as $key => $stage) {
            $stages[$key] = in_array($stage, [Order::STAGE_START, Order::STAGE_FINISH]) ? $stage : Order::STAGE_START;
        }
        $entity->setStages($stages);


        $car = new Car();
        $this->carSerializer->deserialize($car, $data['car']);
        $entity->setCar($car);

        $client = new Client();
        $this->clientSerializer->deserialize($client, $data['client']);
        $entity->setClient($client);
    }

    /**
     * @param Order $entity
     * @return array
     */
    public function serialize($entity): array
    {
        $result = [
            'car' => $this->carSerializer->serialize($entity->getCar()),
            'client' => $this->clientSerializer->serialize($entity->getClient()),
            'stages' => $entity->getStages()
        ];

        if (!empty($entity->getId())) {
            $result['id'] = $entity->getId();
        }

        return $result;
    }
}
