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
    public $client;
    public function __construct(HttpClient $client, array $options = [])
    {
        parent::__construct('Order', $client, $options);
    }

    public function getDistanceAndTime(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'distance-and-time');

        return $this->client->get($uri, $params, $options);
    }

    public function getNextActivity(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'next-activity');

        return $this->client->get($uri, $params, $options);
    }

    public function dispatch(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'dispatch');

        return $this->client->post($uri, $params, $options);
    }

    public function start(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'start');

        return $this->client->post($uri, $params, $options);
    }

    public function updateActivity(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'update-activity');

        return $this->client->post($uri, $params, $options);
    }

    public function setDestination(string $id, string $destinationId, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'set-destination/' . $destinationId);

        return $this->client->post($uri, $params, $options);
    }

    public function captureQrCode(string $id, $subjectId = null, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'capture-qr' . $subjectId !== '' ? '' : '/' . $subjectId);

        return $this->client->post($uri, $params, $options);
    }

    public function captureSignature(string $id, $subjectId = null, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'capture-signature' . $subjectId !== '' ? '' : '/' . $subjectId);

        return $this->client->post($uri, $params, $options);
    }

    public function complete(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'complete');

        return $this->client->post($uri, $params, $options);
    }

    public function cancel(string $id, $params = [], $options = [])
    {
        $uri = $this->uriForResource($id, 'cancel');

        return $this->client->delete($uri, $params, $options);
    }
}
