<?php

namespace App\Serializer;

interface Deserializer
{
    public function support($entity): bool;
    public function deserialize($entity, array $data);
}
