<?php

namespace App\Entity;

use App\DataStructure\ArrayCollection;

class Characteristic implements Identifiable
{
    private ?int $id;

    private ?string $name;

    private ?array $allowableValues;

    private $value;

    private ?string $unitOfMeasure;

    private ArrayCollection $supportedCarTypes;

    public function __construct()
    {
        $this->supportedCarTypes = new ArrayCollection();
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
     * @return Characteristic
     */
    public function setId(?int $id): Characteristic
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Characteristic
     */
    public function setName(?string $name): Characteristic
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAllowableValues(): ?array
    {
        return $this->allowableValues;
    }

    /**
     * @param array|null $allowableValues
     * @return Characteristic
     */
    public function setAllowableValues(?array $allowableValues): Characteristic
    {
        $this->allowableValues = $allowableValues;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Characteristic
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnitOfMeasure(): ?string
    {
        return $this->unitOfMeasure;
    }

    /**
     * @param string|null $unitOfMeasure
     * @return Characteristic
     */
    public function setUnitOfMeasure(?string $unitOfMeasure): Characteristic
    {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSupportedCarTypes(): ArrayCollection
    {
        return $this->supportedCarTypes;
    }

    public function addCharacteristic(CarType $carType)
    {
        $this->supportedCarTypes->add($carType);
    }

    public function removeCharacteristic(CarType $carType)
    {
        $this->supportedCarTypes->removeElement($carType);        //todo maybe return
    }

    public function hasCharacteristic(CarType $carType): bool
    {
        return $this->supportedCarTypes->contains($carType);
    }
}
