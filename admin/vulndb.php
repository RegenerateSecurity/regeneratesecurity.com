<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

$result = $mysqli->query("SELECT id,name,hidden FROM vulns");
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin VulnDB</h1>
<p>Update vulnerability description details</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
<table>
<tbody>
<tr><th>ID</th><th>Name</th><th>Edit</th><th>Hidden</th></tr>
<?php
while($row = $result->fetch_assoc()) {
  $id   = clean($row['id']);
  $name = clean($row['name']);
  $hidden = clean($row['hidden']);

  print '<tr>';
  print '<td>' . $id . '</td>';
  print '<td>' . $name . '</td>';
  print '<td>';
  if ($hidden == 1) { print "Hidden"; } else { print "Visible"; }
  print '</td>';
  print '<td><a href="/admin/edit-vuln/' . $id . '/"><input class="admin-button" type="button" value="Edit"></a></td>';
  print '</tr>';

}
?>
</tbody>
</table>
<a href="/admin/new-vuln/"><input class="admin-button" type="button" value="Create"></a>
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
