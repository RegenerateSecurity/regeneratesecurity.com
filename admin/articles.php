<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (!isset($session['privs']) or $session['privs'] != 2) {
  softRedirect('/login/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Admin Articles</h1>
<p>Description here</p>
</div>
</div>
<div class="content-wrapper">
<div class="content-block">
Foobar
</div>
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
