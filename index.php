<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<!-- <script type="module" src="rollup.config.js"></script> -->
	<script type="module">
	//const input = ['src/fleetbase.js'];
	//import Fleetbase from '@fleetbase/sdk';
	//import Fleetbase from './dist/@fleetbase/sdk.min.js';
	//const fleetbase = new Fleetbase();
	//console.log(fleetbase);

	/*import Fleetbase from '@fleetbase/sdk';

	const fleetbase = new Fleetbase();
	const contact = fleetbase.contacts.create({
  		name: 'Ron',
  		phone: '+65 9999 8888'
 	});*/
	// create a place
	/*const speceNeedle = await fleetbase.places.create({
	  name: 'Space Needle',
	  street1: '400 Broad Street',
	  city: 'Seattle',
	  state: 'WA',
	  country: 'US'
	});*/
	//contact.save();
	</script>


	<?php

$curl = curl_init();

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
    '-u: flb_live_L2HVcQF9SzH5hJFWI9Hx'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
</head>
<body>

</body>
</html>