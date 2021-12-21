<?php

use Jecar\Core\Services\JecarService;
use PHPUnit\Framework\TestCase;

class JecarServiceTest extends TestCase
{

    public function testServiceInstance()
    {
        $obj = new JecarService;
        $this->assertInstanceOf(JecarService::class, $obj);
    }

    public function testGetConfig()
    {
        $obj = new JecarService;

        $this->assertIsArray($obj->getConfig());
    }

    public function testGetTableName()
    {
        $obj = new JecarService;

        $this->assertNotNull($obj->getTableName(''));
    }

}