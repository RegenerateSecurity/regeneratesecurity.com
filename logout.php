<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (isset($_COOKIE['sessionToken'])) {
  $response = postJson('logoutSession', '1.0', json_encode(array('token' => $_COOKIE['sessionToken'])));
  $responseJson = json_decode($response, true);
  if ($responseJson === null) {
    print 'API Error'; // Handle me Daddy
  }
  else if (isset($responseJson['error'])) {
    print '[!] ' . $responseJson['error'] . PHP_EOL;
  }
  else if (isset($responseJson['result'])) { // TODO: consider successful and invalid-logout separately
   softRedirect('/');
  }
  else {
    print 'API Error'; // Do something
  }
}
else {
   softRedirect('/');
}
?>

