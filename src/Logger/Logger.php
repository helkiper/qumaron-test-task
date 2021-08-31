<?php

namespace App\Logger;

interface Logger
{
    public function info(string $message): void;
}
