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

$name         = clean($row['name']);
$description  = clean($row['description']);
$analysis     = clean($row['analysis']);
$remediation  = clean($row['remediation']);
$synopsis     = clean($row['synopsis']);
$cvssv2       = clean($row['CVSSv2Base']);
$cvssv2vector = clean($row['CVSSv2Vector']);
$cvssv3       = clean($row['CVSSv3Base']);
$cvssv3vector = clean($row['CVSSv3Vector']);

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
<h3>Description</h3>
<p><?php print $description; ?></p>
<h3>Remediation</h3>
<p><?php print $remediation; ?></p>
<h3>Technical Analysis</h3>
<p><?php print $analysis; ?></p>
<table><tbody>
<tr><td><strong>Impact:</strong></td><td><?php print $impact; ?></td><br />
<tr><td><strong>Probability:</strong></td><td><?php print $probability; ?></td></p>
<tr><td><strong>CVSSv3 Base:</strong></td><td><?php print $cvssv3; ?></td></p>
<tr><td><strong>CVSSv3 Vector:</strong></td><td><?php print $cvssv3vector; ?></td></p>
<tr><td><strong>CVSSv2 Base:</strong></td><td><?php print $cvssv2; ?></td></p>
<tr><td><strong>CVSSv2 Vector:</strong></td><td><?php print $cvssv2vector; ?></td></p>
</tbody></table>
</div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
