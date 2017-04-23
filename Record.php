<?php

namespace Nirolf\Component\GeoIP;

class Record
{

    /**
     * @var
     */
    protected $ip;

    /**
     * @var
     */
    protected $country_code;

    /**
     * @var
     */
    protected $country_code_3;

    /**
     * @var string
     */
    protected $country_name;

    /**
     * @var
     */
    protected $region;

    /**
     * @var
     */
    protected $city;

    /**
     * @var
     */
    protected $postal_code;

    /**
     * @var
     */
    protected $latitude;

    /**
     * @var
     */
    protected $longitude;

    /**
     * @var
     */
    protected $metro_code;

    /**
     * @var
     */
    protected $continent_code;

    public static function create(
        $ip,
        $region,
        $city,
        $continent_code,
        $country_code,
        $country_code_3,
        $latitude,
        $longitude,
        $metro_code,
        $postal_code,
        $country_name
    )
    {
        $self = new self();
        $self->ip = $ip;
        $self->region = $region;
        $self->city = $city;
        $self->continent_code = $continent_code;
        $self->country_code = strtoupper($country_code);
        $self->country_code_3 = strtoupper($country_code_3);
        $self->latitude = $latitude;
        $self->longitude = $longitude;
        $self->metro_code = $metro_code;
        $self->postal_code = $postal_code;
        $self->country_name = $country_name;

        return $self;
    }

    public function isNull()
    {
        return empty($this->country_code);
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $continent_code
     */
    public function setContinentCode($continent_code)
    {
        $this->continent_code = $continent_code;
    }

    /**
     * @return mixed
     */
    public function getContinentCode()
    {
        return $this->continent_code;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param mixed $country_code_3
     */
    public function setCountryCode3($country_code_3)
    {
        $this->country_code_3 = $country_code_3;
    }

    /**
     * @return mixed
     */
    public function getCountryCode3()
    {
        return $this->country_code_3;
    }

    /**
     * @param mixed $country_name
     */
    public function setCountryName($country_name)
    {
        $this->country_name = $country_name;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $metro_code
     */
    public function setMetroCode($metro_code)
    {
        $this->metro_code = $metro_code;
    }

    /**
     * @return mixed
     */
    public function getMetroCode()
    {
        return $this->metro_code;
    }

    /**
     * @param mixed $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return int
     */
    public function getIpAsLong()
    {
        return ip2long($this->ip);
    }

    /**
     * @param $ipaddress string|long
     * @return $this Record
     */
    public function setIp($ipaddress)
    {
        if (is_int($ipaddress)) $ipaddress = long2ip($ipaddress);
        $this->ip = $ipaddress;
        return $this;
    }

    public function toArray()
    {
        return array(
            "ip" => $this->getIp(),
            "country_code" => $this->getCountryCode(),
            "country_code3" => $this->getCountryCode3(),
            "country_name" => $this->getCountryName(),
            "region" => $this->getRegion(),
            "city" => $this->getCity(),
            "postal_code" => $this->getPostalCode(),
            "latitude" => $this->getLatitude(),
            "longitude" => $this->getLongitude(),
            "metro_code" => $this->getMetroCode(),
            "continent_code" => $this->getContinentCode()
        );
    }
}
