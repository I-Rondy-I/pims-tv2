<?php

namespace PimsTv;

class Report
{
    public function __construct(
        private string $rule,
        private bool $status,
        private string $message,
        private int $timestamp
    ) {
    }

    public function getRule(): string
    {
        return $this->rule;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
