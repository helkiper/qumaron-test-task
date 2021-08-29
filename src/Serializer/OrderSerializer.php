<?php

namespace App\Serializer;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Order;
use App\Main\Configuration;
use Exception;

class OrderSerializer implements Deserializer, Serializer
{

    public function support($entity, array $data): bool
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
        $carDeserializer = new CarSerializer(); //todo inject
        $carDeserializer->deserialize($car, $data['car']);
        $entity->setCar($car);

        $client = new Client();
        $clientDeserializer = new ClientSerializer();  //todo inject
        $clientDeserializer->deserialize($client, $data['client']);
        $entity->setClient($client);
    }

    /**
     * @param Order $entity
     * @return array
     */
    public function serialize($entity): array
    {
        $carSerializer = new CarSerializer(); //todo inject
        $clientSerializer = new ClientSerializer(); //todo inject

        $result = [
            'car' => $carSerializer->serialize($entity->getCar()),
            'client' => $clientSerializer->serialize($entity->getClient())
        ];

        if (!empty($entity->getId())) {
            $result['id'] = $entity->getId();
        }

        return $result;
    }
}
