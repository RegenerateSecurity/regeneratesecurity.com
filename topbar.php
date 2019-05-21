<?php
function drawTopBar() {
  print '<a href="/login/">Sign in</a>' . ' | ' . '<a href="/register/">Register</a>';
}
?>

<div class="top-bar">
  <div class="logo"><a href="/">RegenSec</a></div>
  <div><?php drawTopBar(); ?></div>
</div>
