<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;

class WeatherTime extends ObjectType
{
    public function __construct(Weather $weather)
    {
        parent::__construct([
            'name' => 'WeatherTime',
            'fields' => [
                'now' => [
                    'type' => $weather,
                    'resolve' => function () : string
                    {
                        return "now";
                    }
                ],
                'future' => [
                    'type' => $weather,
                    'resolve' => function () : string
                    {
                        return "future";
                    }
                ]
            ]
        ]);
    }
}
