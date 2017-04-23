<?php

namespace Nirolf\Component\GeoIP\Adapter;

use Nirolf\Component\GeoIP\Record;

class MaxmindAdapter implements AdapterInterface
{
    /**
     * @var \GeoIP
     */
    private $gi = null;

    /**
     * @var string
     */
    private $db_filename;

    public function __construct($db_filename)
    {
        register_shutdown_function(array($this, 'shutdownHandler'));

        $this->db_filename = $db_filename;
    }

    public function shutdownHandler()
    {
        // try to close geoip resources only if it's actually needed
        if ($this->gi) {
            geoip_close($this->getGI());
        }
    }

    /**
     * @return \GeoIP
     */
    private function getGI()
    {
        if ($this->gi === null) {
            $this->gi = geoip_open($this->db_filename, GEOIP_STANDARD);
        }

        return $this->gi;
    }

    /**
     * @param string $ipaddress
     * @return Record|null
     */
    public function resolveIp($ipaddress)
    {
        //hardcode for Kuweit in MaxMind
        if (strpos($ipaddress, "37.38.229.") === 0) {
            $record = Record::create(
                $ipaddress,
                51,
                "",
                "",
                "KW",
                "",
                29.3375,
                47.6581,
                "",
                ""
            );
            return $record;
        }

        //hardocde for spain in MaxMind
        if (strpos($ipaddress, "149.11.144") === 0) {
            $record = Record::create(
                $ipaddress,
                51,
                "Padul",
                "",
                "ES",
                "",
                37.01,
                -3.63,
                "",
                "",
                ""
            );
            return $record;
        }

        /** @var \geoiprecord $giRecord */
        $giRecord = geoip_record_by_addr($this->getGI(), $ipaddress);

        $record = Record::create(
            $ipaddress,
            $giRecord->region,
            $giRecord->city,
            $giRecord->continent_code,
            $giRecord->country_code,
            $giRecord->country_code3,
            $giRecord->latitude,
            $giRecord->longitude,
            $giRecord->metro_code,
            $giRecord->postal_code,
            $giRecord->country_name
        );

        return $record;
    }
}
