<?php

namespace App\Entity;

interface Identifiable
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id);
}
