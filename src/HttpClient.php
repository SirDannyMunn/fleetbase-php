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

namespace Fleetbase\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Exception;

/**
 * Fleetbase PHP SDK HTTP Client
 */
class HttpClient
{
    private string $host;
    private string $namespace;
    private array $options = [];
    private Client $client;
    private Response $lastResponse;

    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->host = $options['host'];
        $this->namespace = $options['namespace'];
        $this->client = $this->createClient($options);
    }

    public function setHost(string $host) : HttpClient
    {
        $this->host = $this->options['host'] = $host;
        $this->client = $this->createClient();

        return $this;
    }

    public function setNamespace(string $namespace) : HttpClient
    {
        $this->namespace = $this->options['namespace'] = $namespace;
        $this->client = $this->createClient();

        return $this;
    }

    public function getHost() : string
    {
        return $this->host;
    }

    public function getNamespace() : string
    {
        return $this->namespace;
    }

    public function getOptions() : array
    {
        return $this->options;
    }

    public function getLastResponse() : Response
    {
        return $this->lastResponse;
    }

    private function createClient(?array $options = null) : Client
    {
        $options = $options ?? $this->getOptions();

        $client = new Client(
            [
            'base_uri' => $this->buildRequestUrl(),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $options['publicKey']
            ]
            ]
        );

        return $client;
    }

    private function buildRequestUrl(string $path = '') : string
    {
        $url = trim($this->host . '/' . $this->namespace . '/' . $path);
        return $url;
    }

    private function makeRequest(string $path, string $method = 'GET', array $data = [], array $options = [])
    {
        if ($method === 'GET') {
            $options['query'] = $data;
        } else {
            $options['json'] = $data;
        }

        $options['http_errors'] = false;

        // make request via client
        $this->lastResponse = $response = $this->client->request($method, $path, $options);

        // run before hook
        if (isset($options['onBefore']) && is_callable($options['onBefore'])) {
            call_user_func($options['onBefore']);
        }

        // get response body and contents
        $body = $response->getBody();
        $contents = $body->getContents();
        $json = json_decode($contents);

        // if error response throw exception
        if (is_object($json) && isset($json->error)) {
            throw new Exception($json->error);
        }

        // run after hook
        if (isset($options['onAfter']) && is_callable($options['onAfter'])) {
            call_user_func($options['onAfter'], $json);
        }

        return $json;
    }

    public function post(string $path, array $data = [], $options = [])
    {
        return $this->makeRequest($path, 'POST', $data, $options);
    }

    public function get(string $path, array $data = [], $options = [])
    {
        return $this->makeRequest($path, 'GET', $data, $options);
    }

    public function delete(string $path, array $data = [], $options = [])
    {
        return $this->makeRequest($path, 'DELETE', $data, $options);
    }

    public function put(string $path, array $data = [], $options = [])
    {
        return $this->makeRequest($path, 'PUT', $data, $options);
    }

    public function patch(string $path, array $data = [], $options = [])
    {
        return $this->makeRequest($path, 'PATCH', $data, $options);
    }
}
