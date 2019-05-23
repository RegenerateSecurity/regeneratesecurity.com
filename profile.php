<?php
$response = postJson('sessionCheck', '1.0', json_encode(array('token' => $_COOKIE['sessionToken'])));
$responseJson = json_decode($response, true);
if ($responseJson === null or isset($responseJson['error'])) {
  print 'Oops';
}
else {
  print $response;
}
?>
