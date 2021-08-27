<?php

namespace App\DataStructure;

use ArrayAccess;
use Countable;
use IteratorAggregate;

interface Collection extends Countable, IteratorAggregate//, ArrayAccess
{
    public function add($element);
    public function clear();
    public function contains($element): bool;
    public function isEmpty(): bool;
//    public function remove($key);
    public function removeElement($element): bool;
//    public function containsKey($key);
    public function get($key);
//    public function getKeys();
//    public function getValues();
    public function set($key, $value);
    public function toArray(): array;
//    public function first();
//    public function last();
//    public function key();
//    public function current();
//    public function next();
//    public function exists(Closure $p);
//    public function filter(Closure $p);
//    public function forAll(Closure $p);
//    public function map(Closure $func);
//    public function partition(Closure $p);
//    public function indexOf($element);
//    public function slice($offset, $length = null);
}
