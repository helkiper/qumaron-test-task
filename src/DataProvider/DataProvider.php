<?php

namespace App\DataProvider;

use App\DataStructure\Collection;

interface DataProvider
{
    /**
     * @param string $entityClass
     * @return Collection
     */
    public function findAll(string $entityClass): Collection;

    /**
     * @param string $entityClass
     * @param int $id
     * @return object|null
     */
    public function find(string $entityClass, int $id): ?object;
}
