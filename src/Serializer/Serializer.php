<?php

namespace App\Serializer;

interface Serializer
{
    public function support($entity): bool;
    public function serialize($entity): array;
}
