<?php

namespace App\DataStructure;

use ArrayIterator;
use Exception;
use Traversable;

class ArrayCollection implements Collection
{
    private array $elements;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param $element
     */
    public function add($element): void
    {
        $this->elements[] = $element;
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * @param $element
     * @return bool
     */
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true); //todo what does mean strict
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

//    public function remove($key)
//    {
//        // TODO: Implement remove() method.
//    }

    /**
     * @param $element
     * @return bool
     */
    public function removeElement($element): bool //todo rename
    {
        $key = array_search($element, $this->elements, true); //todo what does mean strict

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->elements);
    }
}
