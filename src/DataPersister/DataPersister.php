<?php

namespace App\DataPersister;

interface DataPersister
{
    public function store($entity, string $entityClass);
}
