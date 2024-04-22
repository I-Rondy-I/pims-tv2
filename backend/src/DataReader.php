<?php

namespace PimsTv;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class DataReader
{
    public function __construct(
        private FilesystemAdapter $cache,
        private WeatherApiReader $weatherApiReader,
        private PaydayCalculate $paydayCalculate,
        private int $futureTime
    ) {
    }

    public function getWeather($key): object
    {
        return $this->cache->get("weather.{$key}", function (ItemInterface $item) use ($key) {
            if ($key === 'now') {
                $weather = $this->weatherApiReader->getActualWeather();
            } else {
                $weather = $this->weatherApiReader->getFutureWeather($this->futureTime);
            }

            if ($weather->getName() !== null) {
                $item->expiresAfter(600);
            } else {
                $item->expiresAfter(8);
            }

            return (object)[
                'name' => $weather->getName(),
                'temp' => $weather->getTemp(),
                'icon' => $weather->getIcon()
            ];
        });
    }

    public function getPayday(): string
    {
        return $this->cache->get('payday', function (ItemInterface $item) {
            $payday = $this->paydayCalculate->calculate()->getDate();
            $date = $payday->format('Y-m-d');

            $item->expiresAt($payday->endOfDay()->addSecond());

            return $date;
        });
    }
}
