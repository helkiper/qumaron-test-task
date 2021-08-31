<?php

namespace App\Serializer;

interface Serializer
{
    /**
     * @param $entity
     * @return bool
     */
    public function support($entity): bool;

    /**
     * @param $entity
     * @return array
     */
    public function serialize($entity): array;
}
