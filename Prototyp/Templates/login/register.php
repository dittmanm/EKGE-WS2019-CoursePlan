<p>Registrierung zur Verwaltung der Dozenten*innen, der Studiengänge und der Module.</p>
<?php
global $request;
if ($request['s_login'] == 1) {
?>
  <div class="new">
    <form method="POST">
      <p>Benutzername: <input name="username" type="text" /></p>
      <p>Passwort: <input name="password" type="text" /></p>
      <input type='hidden' name="model" value="login" />
      <input type='hidden' name="controller" value="login" />
      <input type='hidden' name="action" value="create" />
      <p><input value="SPEICHERN" name="button" type="submit"></p>
    </form>
  </div>
<?php 
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>