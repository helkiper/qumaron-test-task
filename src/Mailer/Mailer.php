<?php

namespace App\Mailer;

interface Mailer
{
    /**
     * @param string $message
     * @param string $from
     * @param string $to
     * @param string $subject
     */
    public function send(string $message, string $from, string $to, string $subject): void;
}
