<?php

namespace PimsTv\ApiReader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PimsTv\ApiReader;
use PimsTv\App;
use PimsTv\AppReportTime;
use PimsTv\Report;

class Etl implements ApiReader
{

    public function __construct(private string $host, private AppReportTime $appReportTime)
    {
    }

    private function fetch(): object
    {
        $client = new Client();

        $query = <<<GQL
            {
            app {
                status
                healthcheck {
                  rule
                  status
                  messages
                }
              }
            }
        GQL;

        $response = $client->request(
            'POST',
            $this->host,
            [
                'headers' => [
                    'Origin' => 'http://localhost:8000',
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'query' => $query
                ]
            ]
        );

        return json_decode($response->getBody()->getContents());
    }

    public function get(): App
    {
        try {
            $object = $this->fetch();
        } catch (GuzzleException $e) {
            $app = new App("ETL", -1);
            $timestamp = $this->appReportTime->get("etl",false);
            $app->addReport(new Report("Application", false, $e->getMessage(),$timestamp));

            return $app;
        }

        $this->appReportTime->get("etl",true);

        $wrapper = $object->data->app;

        $app = new App("ETL", $wrapper->status);

        foreach ($wrapper->healthcheck as $report) {
            $i = 0;

            $timestamp = $this->appReportTime->get($report->rule, $report->status);

            do {
                $app->addReport(new Report($report->rule, $report->status, $report->messages[$i] ?? "", $timestamp));
                $i++;
            } while ($i < count($report->messages));
        }

        return $app;
    }
}
