<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Vuln DB</h1>
<p>vulnerability Descriptions for use in Security Test Reports</p>
</div>
<div class="content-block">
<table>
<tbody>
<tr><th>ID</th><th>Name</th></tr>
<?php
$result = $mysqli->query("SELECT id,name FROM vulns WHERE hidden = 0;");
while($row = $result->fetch_assoc()) {
  print '<tr><td>' . clean($row['id']) . '</td><td>' . clean($row['name']) . '</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
