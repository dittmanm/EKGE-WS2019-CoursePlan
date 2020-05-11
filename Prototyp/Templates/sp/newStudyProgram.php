<?php
  global $request;
  if ($request['s_login'] == 1) {
?>
  <h2>Studiengang anlegen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" /></p>
      <p>Abschluss:
        <select name="educationalCredentialAwarded" size="1">
          <option value="Bachelor">Bachelor</option>
          <option value="Master">Master</option>
        </select>
      </p>
      <p>Fachbereich:
        <select name="provider" size="1">
          <option value="wirtschaft">Wirtschaft</option>
          <option value="informatik">Informatik</option>
        </select>
      </p>
      <input type='hidden' name="model" value="sp" />
      <input type='hidden' name="controller" value="sp" />
      <input type='hidden' name="action" value="create" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php } else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; } ?>