<?php
  global $request;
  if ($request['s_login'] == 1) {
?>
  <h2>Kollegium anlegen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" /></p>
      <input type='hidden' name="model" value="college" />
      <input type='hidden' name="controller" value="college" />
      <input type='hidden' name="action" value="create" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php } else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; } ?>