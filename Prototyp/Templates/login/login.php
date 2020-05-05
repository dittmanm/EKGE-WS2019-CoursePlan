<?php
  global $request;
  if (isset($request['output'])) {
    $data = $request['output'];
  } else {
    $data = 'Bitte geben Sie Ihr Benutzername und Passwort ein.';
  }
?>
<h2>Login</h2>
<div class="login form">
	<p><?php echo $data; ?></p>
  <form method="POST">
    <p>Benutzername: <input name="username" type="text" /></p>
    <p>Passwort: <input name="password" type="password" /></p>
    <input type='hidden' name="model" value="login" />
    <input type='hidden' name="controller" value="login" />
    <input type='hidden' name="action" value="login" />
    <p><input value="ANMELDEN" type="submit"></p>
  </form>
</div>