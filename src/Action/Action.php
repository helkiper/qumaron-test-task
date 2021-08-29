<?php

namespace App\Action;

abstract class Action
{
    abstract public function run(array $params = []); //todo maybe interface
}
