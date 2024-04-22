<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\AppDataReader;
use PimsTv\FoodDataReader;

class Root extends ObjectType
{
    public function __construct(
        WeatherTime    $weatherTime,
        Payday         $payday,
        Food           $food,
        App            $app,
        AppDataReader  $appDataReader,
        FoodDataReader $foodDataReader
    )
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'weather' => [
                    'type' => $weatherTime,
                    'resolve' => function () {
                        return "";
                    }
                ],
                'payday' => [
                    'type' => $payday,
                    'resolve' => function () {
                        return "";
                    }
                ],
                'food' => [
                    'type' => Type::listOf($food),
                    'resolve' => function () use ($foodDataReader) {
                        return $foodDataReader->get();
                    }
                ],
                'app' => [
                    'type' => Type::listOf($app),
                    'resolve' => function () use ($appDataReader): array {
                        return $appDataReader->get();
                    }
                ]
            ]
        ]);
    }
}
