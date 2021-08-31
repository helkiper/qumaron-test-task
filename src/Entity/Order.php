<?php

namespace App\Entity;

class Order implements Identifiable
{
    public const STAGE_START = 'start';
    public const STAGE_FINISH = 'finish';

    private ?int $id = null;

    private ?Car $car = null;

    private ?Client $client = null;

    private array $stages;

    public function __construct()
    {
        $this->stages = [];
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
     * @return array
     */
    public function getStages(): array
    {
        return $this->stages;
    }

    /**
     * @param array $stages
     * @return Order
     */
    public function setStages(array $stages): Order
    {
        $this->stages = $stages;

        return $this;
    }
}
