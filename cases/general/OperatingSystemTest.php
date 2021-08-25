<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class OperatingSystemTest extends TestCase
{
    # mac
    # linux
    # windows
    # arm

    private string $sapi;

    public function setUp(): void
    {
        $this->sapi = php_sapi_name();
    }

    public function testWindowsOperatingSystem()
    {
        $this->assertEquals("WINNT", PHP_OS);
    }

    public function testLinuxOperatingSystem()
    {
        $this->assertEquals("LINUX", PHP_OS);
    }
}
