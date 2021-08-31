<?php

namespace App\DataStructure;

use Countable;
use IteratorAggregate;

interface Collection extends Countable, IteratorAggregate
{
    /**
     * @param $element
     * @return mixed
     */
    public function add($element);

    /**
     * @return mixed
     */
    public function clear();

    /**
     * @param $element
     * @return bool
     */
    public function contains($element): bool;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @param $element
     * @return bool
     */
    public function removeElement($element): bool;

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * @return array
     */
    public function toArray(): array;
}
