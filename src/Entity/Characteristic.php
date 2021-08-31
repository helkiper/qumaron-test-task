<?php

namespace App\Entity;

class Characteristic implements Identifiable
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     */
    private ?string $name = null;

    /**
     * @var null
     */
    private $value = null;

    /**
     * @var string|null
     */
    private ?string $unitOfMeasure = null;

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
}
