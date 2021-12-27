<?php

/**
 * This file is part of the fleetbase/fleetbase-php library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fleetbase Pte Ltd. <ron@fleetbase.io>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Fleetbase\Sdk;

/**
 * Fleetbase PHP SDK
 */
class Fleetbase
{
    /**
     * Returns a simple and friendly message.
     *
     * @return string
     */
    public function getHello(): string
    {
        return 'Hello, World!';
    }
}
