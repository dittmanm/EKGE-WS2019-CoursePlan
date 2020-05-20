<?php
  global $request;

  if (isset($request['output'])) {
    $data = $request['output'];
  } else {
    $data = 'Bitte geben Sie Benutzername und Passwort ein.';
  }
  ?>
  <h2>Login</h2>
  <?php
  if ($request['s_login'] == 1) {
    echo '<p>Planen Sie die Ressourcen für das neue Semester - legen Sie Dozenten, Module und Studiengänge an. Verwalten Sie die Zugänge zur Lehrplanung.';
  } else {
?>
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
<?php } ?>