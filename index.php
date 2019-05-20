<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="content-wrapper">
<div class="center-text">
<h1 class="black-text">Title Here</h1>
<p>Description here</p>
</div>
<div class="content-block">
<?php postJson('hello/', '1.0', 'ping') ?>
Content here
</div>
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/footer.php';
?>
