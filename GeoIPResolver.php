<?php

namespace Nirolf\Component\GeoIP;

use Nirolf\Component\GeoIP\Adapter\AdapterInterface as GeoIPAdapterInterface;

class GeoIPResolver implements GeoIPAdapterInterface {

    /**
     * @var GeoIPAdapterInterface
     */
    private $geoIpAdapter = null;

    public function __construct(GeoIPAdapterInterface $geoIpAdapter) {
        $this->geoIpAdapter = $geoIpAdapter;
    }

    /**
     * @param $ipaddress string|int
     * @return \Nirolf\Component\GeoIP\Record|null
     */
    public function resolveIp($ipaddress)
    {
        return $this->geoIpAdapter->resolveIp($ipaddress);
    }
}
