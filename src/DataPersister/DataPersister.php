<?php

namespace App\DataPersister;

interface DataPersister
{
    /**
     * @param $entity
     * @param string $entityClass
     */
    public function store($entity, string $entityClass): void;
}
