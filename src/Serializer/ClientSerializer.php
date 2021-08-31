<?php

namespace App\Serializer;

use App\Entity\Client;
use Exception;

class ClientSerializer implements Deserializer, Serializer
{

    /**
     * @param $entity
     * @return bool
     */
    public function support($entity): bool
    {
        return $entity instanceof Client;
    }

    /**
     * @param Client $entity
     * @param array $data
     * @throws Exception
     */
    public function deserialize($entity, array $data)
    {
        if (!isset($data) || !isset($data['name']) || !isset($data['email'])) {
            throw new Exception('client data specified incorrectly');
        }

        $entity
            ->setName($data['name'])
            ->setEmail($data['email']);

        if (isset($data['id'])) {
            $entity->setId($data['id']);
        }
    }

    /**
     * @param Client $entity
     * @return array
     */
    public function serialize($entity): array
    {
        return [
            'name' => $entity->getName(),
            'email' => $entity->getEmail()
        ];
    }
}
