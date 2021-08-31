<?php

namespace App\Action;

interface Action
{
    /**
     * @param array $params
     */
    public function run(array $params = []): void;
}
