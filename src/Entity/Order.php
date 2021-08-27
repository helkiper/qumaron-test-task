<?php

namespace App\Entity;

class Order
{
    private const STATES = ['new' => 'new', 'in work' => 'in work', 'done' => 'done'];  //todo more states

    private ?int $id;

    private ?Car $car;

    private ?Client $client;

    private string $state;

    public function __construct()
    {
        $this->state = self::STATES['new'];
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
     * @return Order
     */
    public function setId(?int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Car|null
     */
    public function getCar(): ?Car
    {
        return $this->car;
    }

    /**
     * @param Car|null $car
     * @return Order
     */
    public function setCar(?Car $car): Order
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client|null $client
     * @return Order
     */
    public function setClient(?Client $client): Order
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Order
     */
    public function setState(string $state): Order
    {
        $this->state = $state;
        return $this;
    }
}
