<?php
  $id = $request["id"];
  $givenName = $request["givenName"];
  $familyName = $request["familyName"];
  $person = new InstructorPerson();
  $data = $person->valuesAction($id);
  $main = new Main();
  $list = $main->queryAction($data);
  foreach ($list as $attribute) {
?>
<h2>Einen neuen Lehrbauftragten anlegen</h2>
<div class="new">
  <form action="index.php">
    <p>Name: <input name="familyName" type="text" value=""/></p>
    <p>Vorname: <input name="givenName" type="text" value="" /></p>
    <p>honorificPrefix: <input name="honorificPrefix" type="text" value="" /></p>
    <p>E-Mail: <input name="email" type="text" value="" /></p>
    <p>Deputatsstunden: <input name="contructualHours" type="text" value="" /></p>
    <p>Minderungsstunden: <input name="reductingHours" type="text" value="" /></p>
    <input type='hidden' name="model" value="ip" />
    <input type='hidden' name="controller" value="ip" />
    <input type='hidden' name="action" value="update" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
  </form>
</div>
<?php } ?>