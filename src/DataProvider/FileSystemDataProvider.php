<?php

namespace App\DataProvider;

use App\DataStructure\ArrayCollection;
use App\DataStructure\Collection;
use App\DependencyInjection\Container;
use App\Main\Configuration;
use App\Serializer\Deserializer;
use App\Util\JsonFile;
use Exception;

class FileSystemDataProvider implements DataProvider
{
    /**
     * @param string $entityClass
     * @return Collection
     * @throws Exception
     */
    public function findAll(string $entityClass): Collection
    {
        $collection = new ArrayCollection();
        $deserializer = $this->selectDeserializer($entityClass);

        $dir = $_SERVER['DOCUMENT_ROOT'] . Configuration::DB_DIR;
        foreach (scandir($dir) as $file) {
            if (strpos($file, $this->classBasename($entityClass)) !== 0) {
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

    /**
     * @param string $entityClass
     * @param int $id
     * @return object|null
     * @throws Exception
     */
    public function find(string $entityClass, int $id): ?object
    {
        $fileName = sprintf(
            '%s/%s%d',
            Configuration::DB_DIR,
            $this->classBasename($entityClass),
            $id
        );

        $entity = new $entityClass();
        $deserializer = $this->selectDeserializer($entityClass);
        $deserializer->deserialize($entity, JsonFile::read($fileName));

        return $entity;
    }

    /**
     * @param string $entityClass
     * @return Deserializer
     * @throws Exception
     */
    private function selectDeserializer(string $entityClass): Deserializer
    {
        $entity = new $entityClass();
        foreach (Container::getInstancesOf(Deserializer::class) as $deserializer) {
            if ($deserializer->support($entity)) {
                return $deserializer;
            }
        }

        throw new Exception('there are no deserializer found to deserializer entity ' . $entityClass);
    }

    /**
     * @param string $entityClass
     * @return false|string
     */
    private function classBasename(string $entityClass)
    {
        return substr($entityClass, strrpos($entityClass, '\\', -1) + 1);
    }
}
