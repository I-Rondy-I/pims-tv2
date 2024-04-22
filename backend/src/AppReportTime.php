<?php

namespace PimsTv;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class AppReportTime
{
    public function __construct(private FilesystemAdapter $cache)
    {
    }

    public function get(string $name, bool $status): int
    {
        $key = "app." . hash("crc32", $name);
        $appDataCache = $this->checkCache($key, $status);

        if ($appDataCache->status !== $status) {
            $this->cache->deleteItem($key);
            $appDataCache = $this->checkCache($key, $status);
        }

        return $appDataCache->timestamp;
    }

    private function checkCache(string $key, bool $status): object
    {
        return $this->cache->get($key, function (ItemInterface $item) use ($status) {
            $item->expiresAt(null);

            return (object)[
                "status" => $status,
                "timestamp" => time()
            ];
        });
    }
}