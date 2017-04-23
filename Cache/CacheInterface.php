<?php

namespace Nirolf\Component\GeoIP\Cache;

interface CacheInterface
{
    /**
     * @param string $cacheKey
     * @param mixed $record
     * @param int $cache_ttl
     * @return bool
     */
    public function set($cacheKey, $record, $cache_ttl);

    /**
     * @param string $cacheKey
     * @return mixed
     */
    public function get($cacheKey);
}
