<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\DataReader;

class Payday extends ObjectType
{
    public function __construct(DataReader $dataReader)
    {
        parent::__construct([
            'name' => 'Payday',
            'fields' => [
                'date' => [
                    'type' => Type::string(),
                    'resolve' => function () use ($dataReader) : string
                    {
                        return $dataReader->getPayday();
                    }
                ]
            ]
        ]);
    }
}
