<?php

namespace Nirolf\Component\GeoIP\Cache;

use Nirolf\Component\GeoIP\Record;

class MemcacheAdapter implements CacheInterface
{
    /**
     * @var \Memcache
     */
    private $memcache;

    public function __construct(\Memcache $memcache)
    {
        $this->memcache = $memcache;
    }

    /**
     * @param string $cacheKey
     * @param mixed $record
     * @param int $cache_ttl
     * @return bool
     */
    public function set($cacheKey, $record, $cache_ttl)
    {
        return $this->memcache->set($cacheKey, $record, MEMCACHE_COMPRESSED, $cache_ttl);
    }

    /**
     * @param string $cacheKey
     * @return mixed
     */
    public function get($cacheKey)
    {
        return $this->memcache->get($cacheKey);
    }
}
