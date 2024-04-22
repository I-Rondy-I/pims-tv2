<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\Food as PimsFood;

class Food extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Food',
            'fields' => [
                'name' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsFood $food): string {
                        return $food->getName();
                    }
                ],
                'time' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsFood $food): string {
                        return $food->getTime();
                    }
                ],
                'message' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsFood $food): string {
                        return $food->getMessage();
                    }
                ]
            ]
        ]);
    }
}
