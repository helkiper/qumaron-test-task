<?php

namespace App\Entity;

class CarType
{
    private ?int $id;

    private ?string $typeName;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return CarType
     */
    public function setId(?int $id): CarType
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    /**
     * @param string|null $typeName
     * @return CarType
     */
    public function setTypeName(?string $typeName): CarType
    {
        $this->typeName = $typeName;
        return $this;
    }
}
