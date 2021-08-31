<?php

namespace App\Logger;

class FileLogger implements Logger
{
    /**
     * @param string $message
     */
    public function info(string $message): void
    {
        echo $message . " - Logged to file\n";
    }
}
