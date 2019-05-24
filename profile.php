<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
$response = postJson('sessionCheck', '1.0', json_encode(array('token' => $_COOKIE['sessionToken'])));
$responseJson = json_decode($response, true);
if (!isset($responseJson['result']) or $responseJson['result'] != 'valid') {
  softRedirect('/login/');
}
else {
  print 'Logged in';
}
?>
