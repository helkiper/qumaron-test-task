<?php

namespace App\Logger;

class FileLogger implements Logger
{
    public function info(string $message): void
    {
        echo $message . " - Logged to file\n";
    }
}
