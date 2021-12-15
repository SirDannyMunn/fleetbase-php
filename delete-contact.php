<?php 
require 'vendor/autoload.php';
// Create a client with a base URI
$client = new GuzzleHttp\Client(['base_uri' => 'https://api.fleetbase.io/v1/']);
// Send a request to https://foo.com/api/test
$resp = $client->request('DELETE', 'contacts/{id}', [
    'headers' => [
        'Authorization' => 'Bearer <your_public_key>',
    ],
]);
echo $resp->getStatusCode();
echo $resp->getBody();
?>