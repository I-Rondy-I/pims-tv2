<?php

namespace PimsTv\Controller;

use Exception;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use GraphQL\GraphQL as GPL;
use GraphQL\Type\Schema;

class GraphQL
{
    public function __construct(private Schema $schema)
    {
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'];

        try {
            $result = GPL::executeQuery($this->schema, $query);
            $output = $result->toArray();
        } catch (Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($output));

        return $response;
    }
}
