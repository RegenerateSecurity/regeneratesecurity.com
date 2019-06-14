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
    !isset($_POST['hidden'])) {
      softRedirect('/admin/edit-vuln/' . clean($_POST['id']) . '/');
}



if ($_POST['name'] == "" or $_POST['slug'] == "" or $_POST['description'] == "" or $_POST['analysis'] == "" or
    $_POST['remediation'] == "" or $_POST['synopsis'] == "" or $_POST['CVSSv2Base'] == "" or $_POST['CVSSv2Vector'] == "" or
    $_POST['CVSSv3Base'] == "" or $_POST['CVSSv3Vector'] == "" or $_POST['hidden'] == "") {
      softRedirect('/admin/edit-vuln/' . intval($_POST['id']) . '/');
}

execPrepare($mysqli,"UPDATE vulns SET name = ?, slug = ?, description = ?, analysis = ?, remediation = ?, synopsis = ?, cvssv2base = ?, cvssv2vector = ?, cvssv3base = ?, cvssv3vector = ?, hidden = ? WHERE id = ?;", array("ssssssssssii", $_POST['name'],$_POST['slug'],$_POST['description'],$_POST['analysis'],$_POST['remediation'],$_POST['synopsis'],$_POST['CVSSv2Base'],$_POST['CVSSv2Vector'],$_POST['CVSSv3Base'],$_POST['CVSSv3Vector'], $_POST['hidden'], $_POST['id']));
softRedirect('/admin/vulndb/');
