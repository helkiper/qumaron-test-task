<?php

namespace App\DataPersister;

use App\DependencyInjection\Container;
use App\Entity\Identifiable;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Serializer\Serializer;
use App\Util\JsonFile;

class FileSystemDataPersister implements DataPersister
{
    public function store($entity, string $entityClass)
    {
        if ($entity instanceof Identifiable && !$entity->getId()) {
            $entity->setId($this->calculateNextId($entityClass));
        }

        /** @var Serializer $serializer */
        foreach (Container::getInstancesOf(Serializer::class) as $serializer) {
            if ($serializer->support($entity)) {
                JsonFile::write(
                    $entityClass . $entity->getId(),
                    $serializer->serialize($entity)
                );

                return;
            }
        }

        throw new \Exception('there are no serializer found to serializer entity ' . $entityClass);
    }

    private function calculateNextId(string $entityClass): int
    {
        return random_int(1, 100);
    }
}
