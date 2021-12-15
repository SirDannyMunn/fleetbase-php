<?php 
namespace Fleetbase\Sdk;

use GuzzleHttp\Client;

class phpInit {

      public $public_key = "";
      public $secret_key = "";
      
      public function my_contacts() {
            require '../../vendor/autoload.php';
            // Create a client with a base URI
            $client = new GuzzleHttp\Client(['base_uri' => 'https://api.fleetbase.io/v1/']);
            // Send a request to https://foo.com/api/test
            $resp = $client->request('GET', 'contacts');
            /*$curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.fleetbase.io/v1/contacts',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->public_key,
              ),
            ));

            $resp = curl_exec($curl);
            curl_close($curl);*/
            return $resp;
      }
  
      public function create_contacts() {
            return $resp;
      }
}
