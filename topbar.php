<?php

function drawTopBar() {
  global $session;
  if (isset($session['privs']) and $session['privs'] > -1) {
    print '<a href="/profile/">Profile</a> | <a href="/logout/">Log Out</a>';
  }
  else {
    print '<a href="/login/">Sign in</a> | <a href="/register/">Register</a>';
  }
}
?>

<div class="top-bar">
  <div class="logo"><a href="/">RegenSec</a></div>
  <div><?php drawTopBar(); ?></div>
</div>
