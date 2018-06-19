<?php

$url = 'https://api.mlab.com/api/1/databases/customers/collections/users?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc';
$data = array( 'id' => trim(com_create_guid(), '{}'),
							'name' => $_POST['fullName'],
              'email' => $_POST['email'],
              'username' => $_POST['username'],
              'password' => $_POST['password']
						);
try {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
      )
  );
  $response = curl_exec($ch);
  $error = curl_error($ch);
  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  $result = json_decode($response, true);
  echo json_encode($result['name']);
} catch (Exception $e) {
  echo "FAIL";
}

//echo true;
?>
