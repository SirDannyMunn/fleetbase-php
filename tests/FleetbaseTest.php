<?php

declare(strict_types=1);

namespace Fleetbase\Sdk\Test;

use Fleetbase\Sdk\Fleetbase;

class FleetbaseTest extends TestCase
{
    public function testInitializeSdk()
    {
        $publicKey = 'flb_test_M9H0c9Iohdc9HQsEcJtR';
    
        $sdk = \Mockery::mock(Fleetbase::class)->setConstructorArgs([$publicKey]);
        $sdk->shouldReceive('getVersion')->passthru();

        $this->assertSame('v1', $sdk->getVersion());
    }
}
