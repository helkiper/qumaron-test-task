<?php

namespace App\DataProvider;

use App\DataStructure\ArrayCollection;
use App\DataStructure\Collection;
use App\DependencyInjection\Container;
use App\Main\Configuration;
use App\Serializer\Deserializer;
use App\Util\JsonFile;

class FileSystemDataProvider implements DataProvider
{

    public function findAll(string $entityClass): Collection
    {
        $collection = new ArrayCollection();
        $deserializer = $this->selectDeserializer($entityClass);

        $entityShortClassName = substr($entityClass, strrpos($entityClass, '\\', -1) + 1);

        foreach (scandir($_SERVER['DOCUMENT_ROOT'] . Configuration::DB_DIR) as $file) {
            if (strpos($file, $entityShortClassName) !== 0) {
                continue;
            }

            $entity = new $entityClass();
            $deserializer->deserialize($entity, JsonFile::read(
                Configuration::DB_DIR . '/' . $file
            ));
            $collection->add($entity);
        }

        return $collection;
    }

    private function selectDeserializer(string $entityClass): Deserializer
    {
        $entity = new $entityClass();
        foreach (Container::getInstancesOf(Deserializer::class) as $deserializer) {
            if ($deserializer->support($entity)) {
                return $deserializer;
            }
        }

        throw new \Exception('there are no deserializer found to deserializer entity ' . $entityClass);
    }
}
