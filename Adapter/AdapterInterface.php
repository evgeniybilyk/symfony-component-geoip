<?php

namespace Nirolf\Component\GeoIP\Adapter;

interface AdapterInterface
{
    /**
     * @param string $ipaddress
     * @return \Nirolf\Component\GeoIP\Record|null
     */
    public function resolveIp($ipaddress);
}
