<?php

namespace PimsTv;

class Food
{
    public function __construct(
        private string $name,
        private string $time,
        private string $message
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
