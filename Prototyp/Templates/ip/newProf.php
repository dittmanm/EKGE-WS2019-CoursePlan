<h2>Dozent*in anlegen</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <input name="familyName" type="text" /></p>
    <p>Vorname: <input name="givenName" type="text" /></p>
    <p>Titel: <input name="honorificPrefix" type="text" /></p>
    <p>E-Mail: <input name="email" type="text" /></p>
    <p>Deputatsstunden: <input name="contructualHours" type="text" /></p>
    <p>Minderungsstunden: <input name="reductingHours" type="text" /></p>
    <input type='hidden' name="model" value="ip" />
    <input type='hidden' name="controller" value="ip" />
    <input type='hidden' name="action" value="create" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
    <p><input value="ZURÜCKSETZEN" name="button" type="reset"></p>
  </form>
</div>