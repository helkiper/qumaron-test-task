<?php

namespace App\Logger;

interface Logger
{
    /**
     * @param string $message
     */
    public function info(string $message): void;
}
