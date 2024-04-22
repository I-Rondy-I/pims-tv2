<?php

namespace PimsTv\ApiReader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PimsTv\ApiReader;
use PimsTv\App;
use PimsTv\AppReportTime;
use PimsTv\Report;

class Vies implements ApiReader
{

    public function __construct(private string $host, private AppReportTime $appReportTime)
    {
    }

    private function fetch(): object
    {
        $client = new Client();

        $response = $client->request(
            'GET',
            $this->host
        );

        return json_decode($response->getBody()->getContents());
    }

    public function get(): App
    {
        try {
            $object = $this->fetch();
        } catch (GuzzleException $e) {
            $app = new App("VIES", -1);
            $timestamp = $this->appReportTime->get("vies", false);
            $app->addReport(new Report("Application", false, $e->getMessage(), $timestamp));

            return $app;
        }

        $this->appReportTime->get("vies", true);

        $wrapper = $object->data->app;

        $app = new App("VIES", $wrapper->status);

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