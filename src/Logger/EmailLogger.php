<?php

namespace App\Logger;

class EmailLogger implements Logger
{
    /**
     * @param string $message
     */
    public function info(string $message): void
    {
        echo $message . " - Logged to email\n";
    }
}
