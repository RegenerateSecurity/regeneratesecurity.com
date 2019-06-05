<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

$result = $mysqli->query("SELECT MAX(id) AS highestID FROM vulns;");
$row    = $result->fetch_assoc();
$id     = intval(clean($row['highestID'])) + 1;
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin VulnDB</h1>
<p>New VulnDB</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
<form method="POST" action="/admin/insert-vuln/">

<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly>
<input class="login-input" name="name" placeholder="Name">
<input class="login-input" name="slug" placeholder="Slug">
<input class="login-input" name="synopsis" placeholder="Synopsis">
<input class="login-input" name="description" placeholder="Description">
<input class="login-input" name="remediation" placeholder="Remediation">
<input class="login-input" name="analysis" placeholder="Analysis">
<input class="login-input" name="CVSSv3Base" placeholder="CVSSv3 Base">
<input class="login-input" name="CVSSv3Vector" placeholder="CVSSv3Vector">
<input class="login-input" name="CVSSv2Base" placeholder="CVSSv2 Base">
<input class="login-input" name="CVSSv2Vector" placeholder="CVSSv2 Vector">
<input class="admin-button" type="submit">
</form>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
