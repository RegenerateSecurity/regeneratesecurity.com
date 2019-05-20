<html>
<head>
 <title>Regenerate Security</title>
 <link rel="stylesheet" type="text/css" href="/theme/main.css" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
</head>
<body>
<?php
$response = postJson('hello', '1.0', json_encode(array('ping' => 'hello')));
$responseJson = json_decode($response, true);
if ($responseJson === null or $responseJson['ping'] != "olleh") {
  print '<div class="api-status">Service Status: API ERROR</div>';
}
else {
  print '<div class="api-status">Service Status: API GOOD</div>';
}
?>
<div class="api-status">
<div class="cookie-law">
<div class="cookie-text"><p><a href="/cookies.php">This site uses cookies; You can click here to change your cookie settings or learn more.</a></p></div>
<div class="cookie-button"><input class="admin-button" type="button" value="Dismiss"></div></p>
</div>
