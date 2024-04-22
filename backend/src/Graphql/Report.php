<?php

namespace PimsTv\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use PimsTv\Report as PimsReport;

class Report extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Report',
            'fields' => [
                'rule' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsReport $report): string {
                        return $report->getRule();
                    }
                ],
                'status' => [
                    'type' => Type::boolean(),
                    'resolve' => function (PimsReport $report): bool {
                        return $report->getStatus();
                    }
                ],
                'message' => [
                    'type' => Type::string(),
                    'resolve' => function (PimsReport $report): string {
                        return $report->getMessage();
                    }
                ],
                'timestamp' => [
                    'type' => Type::int(),
                    'resolve' => function (PimsReport $report): int {
                        return $report->getTimestamp();
                    }
                ]
            ]
        ]);
    }
}
