<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

$result = $mysqli->query("SELECT id,name,slug FROM vulns WHERE hidden = 0;");
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin VulnDB</h1>
<p>Description here</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
<?php
$result = $mysqli->query("SELECT id,name,slug FROM vulns WHERE hidden = 0;");
while($row = $result->fetch_assoc()) {
  print '<tr><td>' . clean($row['id']) . '</td><td><a href="/admin/edit-vuln/' . clean($row['id']) . '/">' . clean($row['name']) . '</a></td></tr>';
}
?>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
