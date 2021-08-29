<?php

namespace App\DataPersister;

use App\Entity\Identifiable;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Util\JsonFile;

class FileSystemDataPersister implements DataPersister
{
    public function store($entity, string $entityClass)
    {
        if ($entity instanceof Identifiable && !$entity->getId()) {
            $entity->setId($this->calculateNextId($entityClass));
        }

        $orderSerializer = new OrderSerializer();

        JsonFile::write(
            $entityClass . $entity->getId(),
            $orderSerializer->serialize($entity)
        );
    }

    private function calculateNextId(string $entityClass): int
    {
        return random_int(1, 100);
//        $files = preg_grep(
//            "/^(" . $entityClass . ")d+$/", //todo remove namespace
//            scandir($_SERVER['DOCUMENT_ROOT'] . Configuration::DB_DIR)
//        ); //todo duplicated
//        if (empty($files)) {
//            return 1;
//        }
//
//        $maxId = str_replace($entityClass, '', end($files));
//
//        return $maxId + 1;
    }
}
