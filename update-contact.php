<?php 
require 'vendor/autoload.php';
// Create a client with a base URI
$client = new GuzzleHttp\Client(['base_uri' => 'https://api.fleetbase.io/v1/']);
// Send a request to https://foo.com/api/test
$resp = $client->request('PUT', 'contacts/{id}', [
    'json' => [
        "name" => "Niamat Khan Edit",
        "type" => "Merchant",
        "email" => "test@niamat.com"
    ],
    'headers' => [
        'Authorization' => 'Bearer <your_public_key>',
    ],
]);
echo $resp->getStatusCode();
echo $resp->getBody();
?>