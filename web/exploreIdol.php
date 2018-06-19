<?php

$url = 'https://api.mlab.com/api/1/databases/customers/collections/users/5b096fbc5d0e6510bd5bd967?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc';
$data = array( 'id' => trim(com_create_guid(), '{}'),
							'name' => 'xx',
              'email' => 'yy',
              'username' => 'tt',
              'password' => 'rr'
						);
try {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_PUT, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
      )
  );
  $response = curl_exec($ch);
  $error = curl_error($ch);
  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  $result = json_decode($response, true);
  echo $result['name'];
} catch (Exception $e) {
  echo "FAIL";
}

//echo true;
?>
