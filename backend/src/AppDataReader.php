<?php

namespace PimsTv;

class AppDataReader
{
    private array $appArray = [];

    public function addAppObject(ApiReader $app): void
    {
        $this->appArray[] = $app;
    }

    public function get(): array
    {
        $dataArray = [];
        foreach ($this->appArray as $app) {
            $dataArray[] = $app->get();
        }
        return $dataArray;
    }
}
