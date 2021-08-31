<?php

namespace App\Service;

class Mailer
{
    public function send(string $message, string $from, string $to, string $subject)
    {
        echo $message;
    }
}
