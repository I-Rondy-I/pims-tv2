<?php

namespace PimsTv;

class Weather
{
    public function __construct(
        private ?string $name,
        private ?float $temp,
        private ?string $icon
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }
}
