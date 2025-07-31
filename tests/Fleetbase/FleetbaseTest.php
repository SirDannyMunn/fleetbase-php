<?php

declare(strict_types=1);

namespace Fleetbase\Sdk\Test\Fleetbase;

use Fleetbase\Sdk\Fleetbase;
use Fleetbase\Sdk\Test\TestCase;

final class FleetbaseTest extends TestCase
{
    public function testInitializeSdk(): void
    {
        $publicKey = $_ENV['FLEETBASE_KEY'];
        $sdk = new Fleetbase($publicKey);
        
        $this->assertInstanceOf(Fleetbase::class, $sdk);
    }

    public function testGetVersion(): void
    {
        $publicKey = $_ENV['FLEETBASE_KEY'];
        $sdk = new Fleetbase($publicKey);

        $this->assertSame('v1', $sdk->getVersion());
    }
}