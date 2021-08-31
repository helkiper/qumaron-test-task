<?php

namespace App\Serializer;

use App\Entity\Car;
use App\Entity\Characteristic;
use App\Main\Configuration;
use Exception;

class CarSerializer implements Deserializer, Serializer
{
    private CharacteristicSerializer $characteristicSerializer;

    public function __construct(CharacteristicSerializer $characteristicSerializer)
    {
        $this->characteristicSerializer = $characteristicSerializer;
    }

    public function support($entity): bool
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
        if (!isset($data['type'])) {
            throw new Exception('incorrect car type');
        }

        if (isset($data['id'])) {
            $entity->setId($data['id']);
        }

        $entity
            ->setModel($data['model'])
            ->setCarType($data['type']);
        
        if (isset($data['characteristics']) && is_array($data['characteristics'])) {
            foreach ($data['characteristics'] as  $value) {
                $characteristic = new Characteristic();
                $this->characteristicSerializer->deserialize($characteristic, $value);
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
        foreach ($entity->getCharacteristics() as $characteristic) {
            $characteristics[] = $this->characteristicSerializer->serialize($characteristic);
        }

        return [
            'type' => $entity->getCarType(),
            'model' => $entity->getModel(),
            'characteristics' => $characteristics
        ];
    }
}
