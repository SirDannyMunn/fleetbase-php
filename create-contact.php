<?php 
require 'vendor/autoload.php';
// Create a client with a base URI
$client = new GuzzleHttp\Client(['base_uri' => 'https://api.fleetbase.io/v1/']);
// Send a request
$resp = $client->request('POST', 'contacts', [
    'json' => [
        "name" => "Niamat Khan",
        "type" => "Freelancer"
    ],
    'headers' => [
        'Authorization' => 'Bearer <your_public_key>',
    ],
]);
echo $resp->getStatusCode();
?>