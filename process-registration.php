<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

// Input handling issues should be checked here and on the API
// If they can be handled here then it prevents requests being
// processed API-side which don't need to.
if ($securimage->check($_POST['captcha_code']) == false) {
  softRedirect('/register.php?error=captcha');
}
else if (!isset($_POST['email']) or !isset($_POST['password']) or !isset($_POST['confirm'])) {
  softRedirect('/register.php?error=missing');
}
else if ($_POST['email'] == "" or $_POST['password'] == "" or $_POST['confirm'] == "") {
  softRedirect('/register.php?error=blank');
}
// TODO: Implement password policy
else if ($_POST['password'] != $_POST['confirm']) {
  softRedirect('/register.php?error=match');
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  softRedirect('/register.php?error=email');
}

$response = postJson('usernameCheck', '1.0', json_encode(array('username' => $_POST['email'])));
$responseJson = json_decode($response, true);
if ($responseJson === null) {
  print 'API Error<br/>';
  exit();
}

if ($responseJson['result'] == "taken") {
  softRedirect('/register.php?error=taken');
}

if ($responseJson['result'] == "available") {
  $response = postJson('createUser', '1.0', json_encode(array('username' => $_POST['email'],'password' => $_POST['password'])));
  $responseJson = json_decode($response, true);
  if ($responseJson === null) {
    print 'API Error<br/>';
  }
  else if ($responseJson['result'] == "created") {
    // TODO: When users lands on profile they should be authenticated
    // COPY-PASTA From Login

    $response = postJson('authenticateUser', '1.0', json_encode(array('username' => $_POST['email'],'password' => $_POST['password'])));
    $responseJson = json_decode($response, true);
    if ($responseJson === null) {
      print 'API Error'; // This should never happen - but throw with an indicator that this was post createUser
      // We should die not exit
      exit();
    }
    if (isset($responseJson['token'])) {
      setcookie ('sessionToken' , htmlspecialchars($responseJson['token']), $expires = time() + 21600, "/", "regeneratesecurity.com", true, true);
      softRedirect('/profile/');
    }
    else {
      print 'API Error: ' . htmlspecialchars($responseJson['error']); // - but throw with aan indicator this was post createUser;
      exit(); // We should die
    }
  }
  else {
    die('API Error: ' . htmlspecialchars($responseJson['error']));
  }
}
else {
  die('API Error: ' . htmlspecialchars($responseJson['error']));
}

?>
