<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\App as PimsApp;

class App extends ObjectType
{
    public function __construct(Report $report)
    {
        parent::__construct([
            'name' => 'App',
            'fields' => [
                'name' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsApp $app) : string
                    {
                        return $app->getName();
                    }
                ],
                'status' => [
                    'type' => Type::int(),
                    'resolve' => function (PimsApp $app) : int
                    {
                        return  $app->getStatus();
                    }
                ],
                'report' => [
                    'type' => Type::listOf($report),
                    'resolve' => function (PimsApp $app) : array
                    {
                        return $app->getReports();
                    }
                ]
            ]
        ]);
    }
}
