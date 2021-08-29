<?php

namespace App\Entity;

interface Identifiable
{
    public function getId(): ?int;

    public function setId(int $id);
}
