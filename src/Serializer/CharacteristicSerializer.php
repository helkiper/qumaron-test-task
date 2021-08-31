<?php

namespace App\Serializer;

use App\Entity\Characteristic;
use Exception;

class CharacteristicSerializer implements Deserializer, Serializer
{

    public function support($entity): bool
    {
        return $entity instanceof Characteristic;
    }

    /**
     * @param Characteristic $entity
     * @param array $data
     * @throws Exception
     */
    public function deserialize($entity, array $data)
    {
        if (!isset($data['name']) || !isset($data['value'])) {
            throw new Exception('characteristic data specified incorrectly');
        }

        if (isset($data['id'])) {
            $entity->setId($data['id']);
        }
        if (isset($data['unitOfMeasure'])) {
            $entity->setUnitOfMeasure($data['unitOfMeasure']);
        }

        $entity
            ->setName($data['name'])
            ->setValue($data['value']);
    }

    /**
     * @param Characteristic $entity
     * @return array
     */
    public function serialize($entity): array
    {
        $result = [
            'name' => $entity->getName(),
            'value' => $entity->getValue()
        ];

        if (!empty($entity->getUnitOfMeasure())) {
            $result['unitOfMeasure'] = $entity->getUnitOfMeasure();
        }

        return $result;
    }
}
