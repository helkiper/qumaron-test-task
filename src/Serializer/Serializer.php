<?php

namespace App\Serializer;

interface Serializer
{
    public function support($entity, array $data): bool;
    public function serialize($entity): array;
}
