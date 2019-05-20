<?php
function drawTopBar() {
  print '<a href="/login.php">Sign in</a>' . | . '<a href="/register.php">Register</a>';
}
?>

<div class="top-bar">
  <div class="logo"><a href="/">RegenSec</a></div>
  <div><?php drawTopBar(); ?></div>
</div>
