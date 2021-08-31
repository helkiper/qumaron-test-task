<?php

namespace App\DataPersister;

use App\DependencyInjection\Container;
use App\Entity\Identifiable;
use App\Serializer\Serializer;
use App\Util\JsonFile;
use Exception;

class FileSystemDataPersister implements DataPersister
{
    /**
     * @param $entity
     * @param string $entityClass
     * @throws Exception
     */
    public function store($entity, string $entityClass): void
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

        throw new Exception('there are no serializer found to serializer entity ' . $entityClass);
    }

    /**
     * @param string $entityClass
     * @return int
     * @throws Exception
     */
    private function calculateNextId(string $entityClass): int
    {
        return random_int(1, 100);
    }
}
