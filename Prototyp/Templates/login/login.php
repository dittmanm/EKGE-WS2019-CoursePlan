<?php
	$table = $_GET["model"];
	$action = $_GET['action'];
	$data = 'Bitte geben Sie Ihr Benutzername und Passwort ein.';
  $id = 1;
?>
<h2>Login</h2>
<div class="login form">
	<p><?php echo $data; ?></p>
  <form action="index.php">
    <p>Benutzername: <input name="username" type="text" /></p>
    <p>Passwort: <input name="password" type="password" /></p>
    <input type='hidden' name="model" value="<?php echo $table; ?>" />
    <input type='hidden' name="controller" value="login" />
    <input type='hidden' name="action" value="login" />
    <p><input value="ANMELDEN" name="button" type="submit"></p>
  </form>
</div>

