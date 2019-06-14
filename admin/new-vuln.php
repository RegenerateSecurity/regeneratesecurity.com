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
<textarea class="login-input" name="synopsis" placeholder="Synopsis" rows=3></textarea>
<textarea class="login-input" name="description" placeholder="Description" rows=10></textarea>
<textarea class="login-input" name="remediation" placeholder="Remediation" rows=10></textarea>
<textarea class="login-input" name="analysis" placeholder="Analysis" rows=3></textarea>
<input class="login-input" name="CVSSv3Base" placeholder="CVSSv3 Base">
<input class="login-input" name="CVSSv3Vector" placeholder="CVSSv3Vector">
<input class="login-input" name="CVSSv2Base" placeholder="CVSSv2 Base">
<input class="login-input" name="CVSSv2Vector" placeholder="CVSSv2 Vector">

<select name="impact" class="login-input">
<option value="0">Informational</option>
<option value="1">Low</option>
<option value="2">Medium</option>
<option value="3">High</option>
<option value="4">Critical</option>
</select>

<select name="probability" class="login-input">
<option value="0">Informational</option>
<option value="1">Low</option>
<option value="2">Medium</option>
<option value="3">High</option>
<option value="4">Critical</option>
</select>

<select class="login-input" name="hidden">
<option value="0">Visible</option>
<option value="1">Hidden</option>
</select>
<input class="admin-button" type="submit">
</form>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
