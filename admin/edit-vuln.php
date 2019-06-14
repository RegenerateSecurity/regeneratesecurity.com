<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

if (!isset($_GET['id'])) {
  softRedirect('/admin/vulndb.php');
}

$result = execPrepare($mysqli, "SELECT * FROM vulns WHERE id = ?;", array("i", $_GET['id']));
$row = $result->fetch_assoc();

$id           = clean($row['id']);
$name         = clean($row['name']);
$slug         = clean($row['slug']);
$description  = clean($row['description']);
$analysis     = clean($row['analysis']);
$remediation  = clean($row['remediation']);
$synopsis     = clean($row['synopsis']);
$cvssv2       = clean($row['CVSSv2Base']);
$cvssv2vector = clean($row['CVSSv2Vector']);
$cvssv3       = clean($row['CVSSv3Base']);
$cvssv3vector = clean($row['CVSSv3Vector']);
$hidden       = clean($row['hidden']);		// TODO: Swap ints from clean() to intval()

?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin VulnDB</h1>
<p>Update vulnerability data</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
<form method="POST" action="/admin/update-vuln/">

<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly>
<input class="login-input" name="name" value="<?php print $name; ?>" placeholder="Name">
<input class="login-input" name="slug" value="<?php print $slug; ?>" placeholder="Slug">
<input class="login-input" name="synopsis" value="<?php print $synopsis; ?>" placeholder="Synopsis">
<input class="login-input" name="description" value="<?php print $description; ?>" placeholder="Description">
<input class="login-input" name="remediation" value="<?php print $remediation; ?>" placeholder="Remediation">
<input class="login-input" name="analysis" value="<?php print $analysis; ?>" placeholder="Analysis">
<input class="login-input" name="CVSSv3Base" value="<?php print $cvssv3; ?>" placeholder="CVSSv3 Base">
<input class="login-input" name="CVSSv3Vector" value="<?php print $cvssv3vector; ?>" placeholder="CVSSv3Vector">
<input class="login-input" name="CVSSv2Base" value="<?php print $cvssv2; ?>" placeholder="CVSSv2 Base">
<input class="login-input" name="CVSSv2Vector" value="<?php print $cvssv2vector; ?>" placeholder="CVSSv2 Vector">
<select name="hidden" class="login-input">
<option <?php if($hidden == 0) { print "selected "; } ?>value="0">Visible</option>
<option <?php if($hidden == 1) { print "selected "; } ?>value="1">Hidden</option>
</select>
<input class="admin-button" type="submit">
</form>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
