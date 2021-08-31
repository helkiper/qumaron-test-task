<?php

namespace App\Serializer;

interface Deserializer
{
    /**
     * @param $entity
     * @return bool
     */
    public function support($entity): bool;

    /**
     * @param $entity
     * @param array $data
     * @return mixed
     */
    public function deserialize($entity, array $data);
}
