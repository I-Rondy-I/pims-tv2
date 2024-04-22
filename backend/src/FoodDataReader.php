<?php

namespace PimsTv;

class FoodDataReader
{
    public function __construct(
        private string $pathToFile
    ) {
    }

    private function getFromFile(): object
    {
        $json = file_get_contents(dirname(__DIR__) . "/{$this->pathToFile}");

        return json_decode($json);
    }

    public function get(): array
    {
        $dataArray = [];

        $foodList = $this->getFromFile();

        foreach ($foodList->food as $food) {
            $dataArray[] = new Food($food->name, $food->time, $food->message);
        }

        return $dataArray;
    }
}