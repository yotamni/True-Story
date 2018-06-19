<?php
  function login($username,$password){
    /*
    $servername = "localhost";
    $username = 'root';
    $password = 'root';
    $conn = mysqli_connect($servername, $username,$password,'first_db');
    // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

      return $username;
*/
try{
      $uid = "1234";
			$url = '
https://api.mlab.com/api/1/databases/customers/collections/users?apiKey=tvG8BMjzxtNwm3fRgQv4LNbcF2IIeWWc';
			$data = array( '_id' => $uid,
							'timestamp' => time(),
							'collected' => false
						);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
			    'Connection: Keep-Alive'
		    ));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
			curl_close($ch);
      return $url;
		}
		catch (Exception $e) {
      return $e;
			$resultArray['result'] = 1;
			$resultArray['resultText'] = substr($e->getMessage(),strpos($e->getMessage(), ' ')+1);
		}

}
  function signup($username,$password,$fullName,$email){
    $string = 9;
    return $string;
  }

?>
