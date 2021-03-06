<?php

namespace App\Entity;

use App\DataStructure\ArrayCollection;

class Car implements Identifiable
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     */
    private ?string $carType = null;

    /**
     * @var string|null
     */
    private ?string $model = null;

    /**
     * @var ArrayCollection
     */
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
     * @return string|null
     */
    public function getCarType(): ?string
    {
        return $this->carType;
    }

    /**
     * @param string|null $carType
     * @return Car
     */
    public function setCarType(?string $carType): Car
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

    /**
     * @param Characteristic $characteristic
     */
    public function addCharacteristic(Characteristic $characteristic)
    {
        $this->characteristics->add($characteristic);
    }

    /**
     * @param Characteristic $characteristic
     */
    public function removeCharacteristic(Characteristic $characteristic)
    {
        $this->characteristics->removeElement($characteristic);
    }

    /**
     * @param Characteristic $characteristic
     * @return bool
     */
    public function hasCharacteristic(Characteristic $characteristic): bool
    {
        return $this->characteristics->contains($characteristic);
    }

    /**
     * @return string
     */
    public function printCharacteristics(): string
    {
        $s = sprintf("\n%s\n", $this->getModel());

        /** @var Characteristic $characteristic */
        foreach ($this->getCharacteristics() as $characteristic) {
            $s .= $characteristic->getName() . ": \t" . $characteristic->getValue() . $characteristic->getUnitOfMeasure() . "\n";
        }

        return $s;
    }
}
