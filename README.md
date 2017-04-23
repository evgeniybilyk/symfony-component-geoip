# Nirolf GeoIP Component

## Installation

```bash
$ composer config repositories.Nirolf-geoip vcs ssh://git@git.111pix.com:7999/mt/Nirolf-geoip.git
$ composer require Nirolf/geoip
```

## Usage

```php
$maxMindDatabaseCity = "/path-to-geoipdb/GeoIPCity.dat";
$maxMindAdapter = new \Nirolf\Component\GeoIP\Adapter\MaxmindAdapter($maxMindDatabaseCity);

$memcache = new \Memcache();
$memcache->addserver("localhost", 11211);

$cacheMemcacheAdapter = new \Nirolf\Component\GeoIP\Cache\MemcacheAdapter($memcache);
$cacheLoggerProxy = new \Nirolf\Component\GeoIP\Cache\LoggerProxy($cacheMemcacheAdapter);
$geoIpCacheProxy = new \Nirolf\Component\GeoIP\Adapter\CacheProxy($maxMindAdapter, $cacheLoggerProxy);

$giResolver = new \Nirolf\Component\GeoIP\GeoIPResolver($geoIpCacheProxy);
$record = $giResolver->resolveIp("24.24.24.24");

var_dump($record);
```

## Tests

You can run the unit tests with the following command:

```bash
$ cd path/to/Nirolf/Component/GeoIp/
$ composer install
$ phpunit
```
