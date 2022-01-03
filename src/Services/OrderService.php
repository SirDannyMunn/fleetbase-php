<?php

/**
 * This file is part of the fleetbase/fleetbase-php library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fleetbase Pte Ltd. <ron@fleetbase.io>
 * @license   http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Fleetbase\Sdk\Services;

use Fleetbase\Sdk\Service;
use Fleetbase\Sdk\HttpClient;

/**
 * Fleetbase PHP SDK Base Resource
 */
class OrderService extends Service
{
    public function __construct(HttpClient $client, array $options = [])
    {
        parent::__construct('Order', $client, $options);
    }

    public function getDistanceAndTime($id, $options = [])
    {
        $uri = $this->uri($id . '/distance-and-time');
        
        return $this->client->get($uri, [], $options);
    }
}
