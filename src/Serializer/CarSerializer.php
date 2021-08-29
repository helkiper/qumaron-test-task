<?php

namespace App\Serializer;

use App\Entity\Car;
use App\Entity\Characteristic;
use App\Main\Configuration;
use Exception;

class CarSerializer implements Deserializer, Serializer
{

    public function support($entity, array $data): bool
    {
        return $entity instanceof Car;
    }

    /**
     * @param Car $entity
     * @param array $data
     * @throws Exception
     */
    public function deserialize($entity, array $data)
    {
        if (!isset($data) ||!isset($data['model'])) {
            throw new Exception('car data specified incorrectly');
        }
        if (!isset($data['type']) || !in_array($data['type'], Configuration::SUPPORTED_CAR_TYPES)) {
            throw new Exception('incorrect car type');
        }

        if (isset($data['id'])) {
            $entity->setId($data['id']);
        }

        $entity
            ->setModel($data['model'])
            ->setCarType($data['type']);
        
        if (isset($data['characteristics']) && is_array($data['characteristics'])) {
            $characteristicsDeserializer = new CharacteristicSerializer();  //todo inject

            foreach ($data['characteristics'] as  $value) {
                $characteristic = new Characteristic();
                $characteristicsDeserializer->deserialize($characteristic, $value);
                //todo if characteristic supported for car type
                $entity->addCharacteristic($characteristic);
            }
        }
    }

    /**
     * @param Car $entity
     * @return array
     */
    public function serialize($entity): array
    {
        $characteristics = [];
        $characteristicSerializer = new CharacteristicSerializer();
        foreach ($entity->getCharacteristics() as $characteristic) {
            $characteristics[] = $characteristicSerializer->serialize($characteristic);
        }

        return [
            'type' => $entity->getCarType(),
            'model' => $entity->getModel(),
            'characteristics' => $characteristics
        ];
    }
}
