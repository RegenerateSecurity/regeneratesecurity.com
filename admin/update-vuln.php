<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

// TODO functinalise?
if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';

if (!isset($_POST['id']) or $_POST['id'] == "") {
  softRedirect('/admin/vulndb/');
}

if (!isset($_POST['name']) or !isset($_POST['slug']) or !isset($_POST['description']) or !isset($_POST['analysis']) or
    !isset($_POST['remediation']) or !isset($_POST['synopsis']) or !isset($_POST['CVSSv2Base']) or
    !isset($_POST['CVSSv2Vector']) or !isset($_POST['CVSSv3Base']) or !isset($_POST['CVSSv3Vector']) or
    !isset($_POST['hidden']) or !isset($_POST['impact']) or !isset($_POST['probability']) or !isset($_POST['refs'])) {
      softRedirect('/admin/edit-vuln/' . clean($_POST['id']) . '/');
}


// TODO - reduce this to only the ones that are required!
// TODO - have this bounce back to the edit form with the acceptable values remembered
if ($_POST['name'] == "" or $_POST['slug'] == "" or $_POST['description'] == "" or $_POST['analysis'] == "" or
    $_POST['remediation'] == "" or $_POST['synopsis'] == "" or $_POST['CVSSv2Base'] == "" or $_POST['CVSSv2Vector'] == "" or
    $_POST['CVSSv3Base'] == "" or $_POST['CVSSv3Vector'] == "" or $_POST['hidden'] == "" or $_POST['impact'] == "" or
    $_POST['probability'] == "" or $_POST['refs'] == "") {
      softRedirect('/admin/edit-vuln/' . intval($_POST['id']) . '/');
}
// TODO - List alternative names for vulns
// TODO - check slug is not taken
// TODO - check ID is not taken
// TODO - check that the CVSS is valid
// TODO - check that the CVSS vectors and base scores match
execPrepare($mysqli,"UPDATE vulns SET name = ?, slug = ?, description = ?, analysis = ?, remediation = ?, synopsis = ?, cvssv2base = ?, cvssv2vector = ?, cvssv3base = ?, cvssv3vector = ?, hidden = ?, impact = ?, probability = ?, refs = ? WHERE id = ?;", array("ssssssssssiiiis", $_POST['name'],$_POST['slug'],$_POST['description'],$_POST['analysis'],$_POST['remediation'],$_POST['synopsis'],$_POST['CVSSv2Base'],$_POST['CVSSv2Vector'],$_POST['CVSSv3Base'],$_POST['CVSSv3Vector'], $_POST['hidden'], $_POST['impact'], $_POST['probability'], $_POST['id'], $_POST['refs']));
softRedirect('/admin/vulndb/');
