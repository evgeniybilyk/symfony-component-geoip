<?php
namespace Nirolf\Component\GeoIP\Adapter;

use Nirolf\Component\GeoIP\Record;
use Nirolf\Component\GeoIP\Cache\CacheInterface as CacheEngineAdapterInterface;

class CacheProxy implements AdapterInterface
{
    const CACHE_VERSION = 1;

    /**
     * @var int
     */
    private $cacheTtl = 3600;

    /**
     * @var AdapterInterface
     */
    private $geoIpAdapter = null;

    /**
     * @var CacheEngineAdapterInterface
     */
    private $cacheEngine = null;

    /**
     * @var string
     */
    private $cacheKeyPref = "geoip";

    /**
     * @param AdapterInterface $geoIpAdapter
     * @param CacheEngineAdapterInterface $cacheEngine
     */
    function __construct(AdapterInterface $geoIpAdapter, CacheEngineAdapterInterface $cacheEngine)
    {
        $this->cacheEngine = $cacheEngine;
        $this->geoIpAdapter = $geoIpAdapter;
    }

    /**
     * @param int $cacheTtl
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * @return int
     */
    public function getCacheTtl()
    {
        return $this->cacheTtl;
    }

    /**
     * @param string $cacheKeyPref
     */
    public function setCacheKeyPref($cacheKeyPref)
    {
        $this->cacheKeyPref = $cacheKeyPref;
    }

    /**
     * @return string
     */
    public function getCacheKeyPref()
    {
        return $this->cacheKeyPref;
    }

    /**
     * @param string $ipaddress
     * @return Record|null
     */
    public function resolveIp($ipaddress)
    {
        $record = $this->getRecordFromCache($ipaddress);

        if ($record) {
            return $record;
        }

        $record = $this->geoIpAdapter->resolveIp($ipaddress);

        $this->putRecordToCache($ipaddress, $record);

        return $record;
    }

    /**
     * @param string $ipaddress
     * @return Record|null
     */
    private function getRecordFromCache($ipaddress)
    {
        $cacheKey = $this->getCacheKey($ipaddress);
        if (!($record = $this->cacheEngine->get($cacheKey)) || !($record instanceof Record)) {
            return null;
        }

        return $record;
    }

    /**
     * @param string $ipaddress
     * @param Record $record
     * @return bool
     */
    private function putRecordToCache($ipaddress, Record $record)
    {
        $cacheKey = $this->getCacheKey($ipaddress);
        return $this->cacheEngine->set($cacheKey, $record, $this->getCacheTtl());
    }

    /**
     * Cache key for caching engine.
     * Structured ([cacheKeyPrefix]:[cacheversion]:ipaddr:[ipaddress] ) - for future use in redis.
     *
     * @param string $ipaddress
     * @return string
     */
    private function getCacheKey($ipaddress)
    {
        return $this->getCacheKeyPref() . ":" . self::CACHE_VERSION . ":ipaddr:" . $ipaddress;
    }
}
