<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';

if (isset($_GET['id']) {
  $result = execPrepare($mysqli, "SELECT id,name,slug FROM articles WHERE id = ?;", array("i", $_GET['id']));
}
else if (isset($_GET['slug']) {
  $result = execPrepare($mysqli, "SELECT id,name,slug FROM articles WHERE slug = ?;", array("s", $_GET['slug']));
}
else {
  softRedirect('/index.php');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Vuln DB</h1>
<p>Vulnerability Descriptions for use in Security Test Reports</p>
</div>
<div class="content-block">
<table>
<tbody>
<tr><th>ID</th><th>Name</th></tr>
<?php
$row = $result->fetch_assoc();
print $row['id'] . '<br/>';
print $row['name'] . '<br/>';
print $row['slug'] . '<br/>';
?>
</tbody>
</table>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
