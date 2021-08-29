<?php

namespace App\DataProvider;

interface DataProvider
{
    public function findAll(string $entityClass);
}
