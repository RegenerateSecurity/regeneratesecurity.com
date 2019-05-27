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

$id   = clean($row['id']);
$name = clean($row['name']);
$slug = clean($row['slug']);
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin VulnDB</h1>
<p>Description here</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
<form>
<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly>
<input class="login-input" name="name" value="<?php print $name; ?>">
<input class="admin-button" type="submit">
</form>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
