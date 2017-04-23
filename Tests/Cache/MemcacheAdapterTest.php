<?php

namespace Nirolf\Component\GeoIP\Tests\Cache;

use Nirolf\Component\GeoIP\Cache\MemcacheAdapter;

/**
 * @author Vitaliy Bilotil <vitaliy.bilotil@filmon.com>
 */
class MemcacheAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function test_MemcacheAdapter()
    {
        $cacheKey = 'cache_key';
        $data = ['ip' => '127.0.0.1'];
        $cacheTtl = 30;

        $memcacheMock = $this->getMemcacheMock();
        $memcacheMock
            ->expects($this->once())
            ->method('set')
            ->with($cacheKey, $data, MEMCACHE_COMPRESSED, $cacheTtl)
            ->willReturn(true)
        ;
        $memcacheMock
            ->expects($this->once())
            ->method('get')
            ->with($cacheKey)
            ->willReturn(true)
        ;

        $memcacheAdapter = new MemcacheAdapter($memcacheMock);
        $this->assertTrue($memcacheAdapter->set($cacheKey, $data, $cacheTtl));
        $this->assertTrue($memcacheAdapter->get($cacheKey));
    }

    private function getMemcacheMock()
    {
        $mock = $this
            ->getMockBuilder('Memcache')
            ->setMethods(array('get', 'set'))
            ->getMock()
        ;

        return $mock;
    }
}
