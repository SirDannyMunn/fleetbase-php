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

namespace Fleetbase\Sdk\Resources;

use Fleetbase\Sdk\Resource;
use Fleetbase\Sdk\Services\OrderService;

/**
 * Fleetbase PHP SDK Base Resource
 */
class Order extends Resource
{
    public function __constructor(array $attributes = [], ?OrderService $service = null, array $options = []) {
        parent::__construct($attributes, $service, $options);
    }

    public function getDistanceAndTime() {
        return $this->service->getDistanceAndTime($this->id);
    }
}
