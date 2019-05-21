<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

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
  print $response;
}
else if ($responseJson['result'] == "taken") {
  print 'Username taken';
}
else if ($responseJson['result'] == "available") {
  print 'Username available';
}
else {
  softRedirect('/register.php?error=unknown');
}

//$email      = $_POST['email'];
//$password   = $_POST['password'];
//$salt       = openssl_random_pseudo_bytes(64);
//$iterations = 10000;
// TODO: It's weird that the algo is hardcoded but nothing else
//$hash       = hash_pbkdf2('sha3-512', $password, $salt , $iterations);
//$privs      = 0;
//if (numPrepare($mysqli, "SELECT email FROM users WHERE email = ?;", array("s", $email))) {
//  softRedirect('register.php?error=taken');
//}
//else {
//  // TODO: Split this for readability
//  $result = execPrepare($mysqli, "INSERT INTO users (email, salt, iterations, hash, privs) VALUES (?, ?, ?, ?, ?);", array("ssisi", $email, $salt, $iterations, $hash, $privs));
//  $_SESSION['email'] = $email;
//  $_SESSION['privs'] = $privs;
//  softRedirect('/profile.php');
//}
?>
