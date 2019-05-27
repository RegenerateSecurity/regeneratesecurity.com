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
<?php
$result = execPrepare($mysqli, $query, $param);
while ($row = $result->fetch_assoc()) {
  print $row['id'] . '<br/>' . $row['name'];
}
?>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
