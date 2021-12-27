<?php

declare(strict_types=1);

namespace Fleetbase\Sdk\Test;

use Fleetbase\Sdk\Fleetbase;

class FleetbaseTest extends TestCase
{
    public function testGetHello()
    {
        $object = \Mockery::mock(Fleetbase::class);
        $object->shouldReceive('getHello')->passthru();

        $this->assertSame('Hello, World!', $object->getHello());
    }
}
