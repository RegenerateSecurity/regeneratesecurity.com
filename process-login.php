
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  softRedirect('/login.php?error=captcha');
}
else if (!isset($_POST['email']) or !isset($_POST['password'])) {
  softRedirect('/login.php?error=missing');
}
else if ($_POST['email'] == "" or $_POST['password'] == "") {
  softRedirect('/login.php?error=blank');
}

$response = postJson('authenticateUser', '1.0', json_encode(array('username' => $_POST['email'],'password' => $_POST['password'])));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  print 'API Error<br/>';
  exit();
}

if (isset($responseJson['token'])) {
  print htmlspecialchars($responseJson['token']);
  exit();
}
else {
  print 'API Error: ' . htmlspecialchars($responseJson['error']);
  exit();
}
?>
