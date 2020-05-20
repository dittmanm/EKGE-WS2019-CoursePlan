<p>Registrierung zur Verwaltung der Dozenten*innen, der Studiengänge und der Module.</p>
<?php
global $request;
if (isset($request['action'])) {
  if($request['action'] === 'create') {
    $main = new Main();
    $main->createUser($request['username'], $request['password']);
    $request['output'] = 'Anlegen eines neuen Benutzers erfolgreich.';
  }
}
if ($request['s_login'] == 1) {
  if (isset($request['output'])) {
    $data = $request['output'];
  } else {
    $data = 'Registrieren Sie hier Personen mit Bearbeitungsrechten - Studiengangleitungen und -verwaltungen.';
  }
?>
  <div class="new">
    <form method="POST">
      <p>Benutzername: <input name="username" type="text" /></p>
      <p>Passwort: <input name="password" type="text" /></p>
      <input type='hidden' name="model" value="login" />
      <input type='hidden' name="controller" value="register" />
      <input type='hidden' name="action" value="create" />
      <p><input value="SPEICHERN" type="submit"></p>
    </form>
  </div>
<?php 
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>