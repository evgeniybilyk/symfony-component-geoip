<?php

namespace Nirolf\Component\GeoIP\Cache;

class LoggerProxy implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    private $cacheEngine = null;

    /**
     * @param CacheInterface $cacheEngine
     */
    function __construct(CacheInterface $cacheEngine)
    {
        $this->cacheEngine = $cacheEngine;
    }

    /**
     * @param string $cacheKey
     * @param mixed $record
     * @param int $cache_ttl
     * @return bool
     */
    public function set($cacheKey, $record, $cache_ttl)
    {
        echo PHP_EOL . "Set cache: $cacheKey";
        $this->cacheEngine->set($cacheKey, $record, $cache_ttl);
    }

    /**
     * @param string $cacheKey
     * @return mixed
     */
    public function get($cacheKey)
    {
        echo PHP_EOL . "Get value from cache: $cacheKey";
        return $this->cacheEngine->get($cacheKey);
    }
}
