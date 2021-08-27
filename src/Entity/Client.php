<?php

namespace App\Entity;

class Client
{
    private ?int $id;

    private ?string $name;

    private ?string $email;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Client
     */
    public function setId(?int $id): Client
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
     * @return Client
     */
    public function setName(?string $name): Client
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Client
     */
    public function setEmail(?string $email): Client
    {
        $this->email = $email;
        return $this;
    }
}
