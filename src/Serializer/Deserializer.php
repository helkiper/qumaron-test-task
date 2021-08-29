<?php

namespace App\Serializer;

interface Deserializer
{
    public function support($entity, array $data): bool;
    public function deserialize($entity, array $data);
}
