<?php

namespace App\Logger;

class EmailLogger implements Logger
{
    public function info(string $message): void
    {
        echo $message . " - Logged to email\n";
    }
}
