
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  softRedirect('/login/?error=captcha');
}
else if (!isset($_POST['email']) or !isset($_POST['password'])) {
  softRedirect('/login/?error=missing');
}
else if ($_POST['email'] == "" or $_POST['password'] == "") {
  softRedirect('/login/?error=blank');
}

$response = postJson('authenticateUser', '1.0', json_encode(array('username' => $_POST['email'],'password' => $_POST['password'])));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  print 'API Error<br/>';
  exit();
}

if (isset($responseJson['token'])) {
  setcookie ('sessionToken' , htmlspecialchars($responseJson['token']), $expires = time() + 21600, "/", "regeneratesecurity.com", true, true);
  softRedirect('/profile/');
}
else {
  print 'API Error: ' . htmlspecialchars($responseJson['error']);
  exit();
}
?>
