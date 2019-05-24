<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/hmac.php';

// A function to execute a prepared query against an array of vars
function execPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result;
}
// A function to execute a prepared query and return the number of rows
function numPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $stmt->store_result();
  $result = $stmt->get_result();
  return $stmt->num_rows;
}
function clean($input) {
  $input = htmlspecialchars($input);	// Abstracted to make custom filtration possible later
  return $input;
}
function softRedirect($target) {	// "Soft" because 302, non-permanent
  $target = str_replace("<", "&gt;", $target);
  $target = str_replace(">", "&lt;", $target);
  $target = str_replace('"', "&quot;", $target);
  $target = str_replace("'", "&apos;", $target);
  header('Location: ' . $target);
  exit();
}
function display($input) {
  $input = str_replace("<", "&lt;", $input);
  $input = str_replace(">", "&gt;", $input);
  $input = str_replace('"', "&quot;", $input);
  $input = str_replace("'", "&apos;", $input);
  $input = str_replace("&lt;h2&gt;", "<h2>", $input);
  $input = str_replace("&lt;/h2&gt;", "</h2>", $input);
  $input = str_replace("&lt;h3&gt;", "<h3>", $input);
  $input = str_replace("&lt;/h3&gt;", "</h3>", $input);
  $input = str_replace("&lt;br&gt;", "<br>", $input);
  $input = preg_replace('&lt;a href="(https{0,1}:\/\/.*?)"&gt;(.*?)&lt;\/a&gt;','<a href="$1">$2</a>', $input);
  return $input;
}

function postJson($endpoint, $version, $payload) {
    global $apiHMAC;
    $signature = hash_hmac('sha3-512' , $payload , $apiHMAC);

    // Setup cURL
    $ch = curl_init('https://api.regeneratesecurity.com/api/'.$version.'/'.$endpoint.'/');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Signature: '.$signature,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => $payload
    ));

    // Send the request
    $response = curl_exec($ch);

    if($response === FALSE){ // Check for errors
        die(curl_error($ch));
    }

    return $response;
}

// Check if a session exists and is still valid and store important data
$session array("privs" => -1);
if (isset($_COOKIE['sessionToken']))) {
  $response = postJson('sessionCheck', '1.0', json_encode(array('token' => $_COOKIE['sessionToken'])));
  $responseJson = json_decode($response, true);
  if (isset($responseJson['result']) and $responseJson['result'] == 'valid') {
    $session array("privs" => $responseJson['privs'], $email => $responseJson['email']);
  }
}
?>
