<?php
session_start();

$url = 'https://api.mlab.com/api/1/databases/customers/collections/users?q={"password":"'.$_POST["password"].'","username":"'.$_POST["username"].'"}&apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc&f={"username":1,"searches":1}';
try {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_GET, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
      )
  );
  $response = curl_exec($ch);
  $error = curl_error($ch);
  $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  $result = json_decode($response, true);
  if(!empty($result))
  {
  //  echo "empty result";
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $_POST["username"];
  }
  //else{

      echo $response;
  //}
} catch (Exception $e) {
  echo "FAIL";
}


//session_unset();

// destroy the session
//session_destroy();

?>
