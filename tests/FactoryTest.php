<?php

use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    const BASE_URL = 'BASE_URL';
    const IMAGE_FILE = 'IMAGE_FILE';

    public function testBaseUrlIsSet()
    {
        $factory = new \Scene7\Factory(self::BASE_URL . '/');
        $this->assertAttributeEquals('BASE_URL/', 'baseUrl', $factory);
    }

    public function testBaseUrlAddsTrailingSlash()
    {
        $factory = new \Scene7\Factory(self::BASE_URL);
        $this->assertAttributeEquals('BASE_URL/', 'baseUrl', $factory);
    }
}