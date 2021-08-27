<?php

namespace App\Entity;

use App\DataStructure\ArrayCollection;

class Car
{
    private ?int $id;

    private ?CarType $carType;

    private ?string $model;

    private ArrayCollection $characteristics;

    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Car
     */
    public function setId(?int $id): Car
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return CarType|null
     */
    public function getCarType(): ?CarType
    {
        return $this->carType;
    }

    /**
     * @param CarType|null $carType
     * @return Car
     */
    public function setCarType(?CarType $carType): Car
    {
        $this->carType = $carType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string|null $model
     * @return Car
     */
    public function setModel(?string $model): Car
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCharacteristics(): ArrayCollection
    {
        return $this->characteristics;
    }

    public function addCharacteristic(Characteristic $characteristic)
    {
        $this->characteristics->add($characteristic);
    }

    public function removeCharacteristic(Characteristic $characteristic)
    {
        $this->characteristics->removeElement($characteristic);        //todo maybe return
    }

    public function hasCharacteristic(Characteristic $characteristic): bool
    {
        return $this->characteristics->contains($characteristic);
    }
}
