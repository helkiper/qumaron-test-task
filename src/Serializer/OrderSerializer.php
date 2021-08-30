<?php

namespace App\Serializer;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Order;
use Exception;

class OrderSerializer implements Deserializer, Serializer
{
    private CarSerializer $carSerializer;
    private ClientSerializer $clientSerializer;

    public function __construct(CarSerializer $carSerializer, ClientSerializer $clientSerializer)
    {
        $this->carSerializer = $carSerializer;
        $this->clientSerializer = $clientSerializer;
    }

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
            'client' => $this->clientSerializer->serialize($entity->getClient())
        ];

        if (!empty($entity->getId())) {
            $result['id'] = $entity->getId();
        }

        return $result;
    }
}
