<?php

namespace App\DataProvider;

use App\DataStructure\ArrayCollection;
use App\DataStructure\Collection;
use App\Entity\Order;
use App\Main\Configuration;
use App\Serializer\OrderSerializer;
use App\Util\JsonFile;

class FileSystemDataProvider implements DataProvider
{

    public function findAll(string $entityClass): Collection
    {
        $collection = new ArrayCollection();

        $files = preg_grep("/^(" . $entityClass . ")d+$/", scandir(Configuration::DB_DIR)); //todo duplicated
        $orderSerializer = new OrderSerializer();
        foreach ($files as $file) {
            $order = new Order();
            $orderSerializer->deserialize($order, JsonFile::read($file));

            $collection->add($order);
        }

        return $collection;
    }
}
