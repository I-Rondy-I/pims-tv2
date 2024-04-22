<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\DataReader;

class Weather extends ObjectType
{
    public function __construct(DataReader $dataReader)
    {
        parent::__construct([
            'name' => 'Weather',
            'fields' => [
                'name' => [
                    'type' => Type::string(),
                    'resolve' => function ($value) use ($dataReader): ?string {
                        return $dataReader->getWeather($value)->name;
                    }
                ],
                'temp' => [
                    'type' => Type::float(),
                    'resolve' => function ($value) use ($dataReader): ?float {
                        return $dataReader->getWeather($value)->temp;
                    }
                ],
                'icon' => [
                    'type' => Type::string(),
                    'resolve' => function ($value) use ($dataReader): ?string {
                        return $dataReader->getWeather($value)->icon;
                    }
                ]
            ]
        ]);
    }
}
