<?php

namespace App\DataProvider;

use App\DataStructure\ArrayCollection;
use App\DataStructure\Collection;
use App\DependencyInjection\Container;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\Deserializer;
use App\Serializer\OrderSerializer;
use App\Serializer\Serializer;
use App\Util\JsonFile;

class FileSystemDataProvider implements DataProvider
{

    public function findAll(string $entityClass): Collection
    {
        $collection = new ArrayCollection();

        $files = preg_grep("/^(" . $entityClass . ")d+$/", scandir(Configuration::DB_DIR)); //todo duplicated
        foreach ($files as $file) {
            /** @var Deserializer $deserializer */
            foreach (Container::getInstancesOf(Deserializer::class) as $deserializer) {
                if ($deserializer->support($entityClass)) {
                    $entity = new $entityClass();
                    $deserializer->deserialize($entity, JsonFile::read($file));
                    $collection->add($entity);

                    continue 2;
                } else {
                    throw new \Exception('there are no deserializer found to deserializer entity ' . $entityClass);
                }
            }
        }

        return $collection;
    }
}
