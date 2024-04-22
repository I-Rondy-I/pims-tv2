<?php

namespace PimsTv;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class WeatherApiReader
{
    public function __construct(
        private string $key,
        private string $endpoint,
        private string $lon,
        private string $lat,
        private FilesystemAdapter $cache
    ) {
    }

    private function fetchFromApi(): ?object
    {
        return $this->cache->get('weather.apiObject', function (ItemInterface $item) {
            try {
                $client = new Client();
                $response = $client->request(
                    'GET',
                    $this->endpoint . "?" .
                    http_build_query([
                        'lat' => $this->lat,
                        'lon' => $this->lon,
                        'appid' => $this->key,
                        'units' => 'metric',
                        'exclude' => 'minutely,daily',
                    ])
                );
                $item->expiresAfter(60);
                return json_decode($response->getBody());
            } catch (GuzzleException $e) {
                $item->expiresAfter(5);
                error_log($e->getMessage());
                return null;
            }
        });
    }

    public function getActualWeather(): Weather
    {
        $weatherApiObject = $this->fetchFromApi();
        if ($weatherApiObject !== null) {
            $temp = $weatherApiObject->current->temp;
            $icon = "https://openweathermap.org/img/wn/{$weatherApiObject->current->weather[0]->icon}@2x.png";

            return new Weather("Aktualnie", $temp, $icon);
        }

        return new Weather(null, null, null);
    }

    public function getFutureWeather(int $hour): Weather
    {
        $weatherApiObject = $this->fetchFromApi();
        if ($weatherApiObject !== null) {
            $firstElement = Carbon::createFromTimestamp($weatherApiObject->hourly[0]->dt)->hour;

            $index = match ($firstElement <=> $hour) {
                -1 => $hour - $firstElement,
                0 => 0,
                1 => 24 + ($hour - $firstElement)
            };

            $temp = $weatherApiObject->hourly[$index]->temp;
            $icon = "https://openweathermap.org/img/wn/{$weatherApiObject->hourly[$index]->weather[0]->icon}@2x.png";

            return new Weather("Na fajrant", $temp, $icon);
        }

        return new Weather(null, null, null);
    }
}
