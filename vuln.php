<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';

if (isset($_GET['id'])) {
  $result = execPrepare($mysqli, "SELECT * FROM vulns WHERE id = ?;", array("i", $_GET['id']));
}
else if (isset($_GET['slug'])) {
  $result = execPrepare($mysqli, "SELECT * FROM vulns WHERE slug = ?;", array("s", $_GET['slug']));
}
else {
  softRedirect('/index.php');
}
$row = $result->fetch_assoc();

$name        = clean($row['name']);
$description = clean($row['description']);
$analysis    = clean($row['analysis']);
$remediation = clean($row['remediation']);
$synopsis    = clean($row['synopsis']);

$impact      = "Not set";
if ($row['impact'] == 3)      { $impact = "High"; }
else if ($row['impact'] == 2) { $impact = "Medium"; }
else if ($row['impact'] == 1) { $impact = "Low"; }

$probability = "Not set";
if ($row['probability'] == 3)      { $probability = "High"; }
else if ($row['probability'] == 2) { $probability = "Medium"; }
else if ($row['probability'] == 1) { $probability = "Low"; }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text"><?php print $name; ?></h1>
<p><?php print $synopsis; ?></p>
</div>
<div class="content-block">
<p><strong>Impact:</strong> <?php print $impact; ?></p>
<p><strong>Probability:</strong> <?php print $probability; ?></p>
<h3>Description</h3>
<p><?php print $description; ?></p>
<h3>Remediation</h3>
<p><?php print $remediation; ?></p>
<h3>Technical Analysis</h3>
<p><?php print $analysis; ?></p>

</div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
