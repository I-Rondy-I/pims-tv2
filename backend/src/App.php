<?php

namespace PimsTv;

class App
{
    private array $reports = [];

    public function __construct(
        private string $name,
        private int $status
    ) {
    }

    public function getReports(): array
    {
        return $this->reports;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function addReport(Report $report): void
    {
        $this->reports[] = $report;
    }
}
