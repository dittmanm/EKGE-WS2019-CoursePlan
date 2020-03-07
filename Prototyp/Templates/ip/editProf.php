<?php
  global $request;
  $person = new InstructorPerson();
  $main = new Main();
  $list = $main->queryAction($person->filterAction('cp:'.$request["id"]));
  foreach ($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
?>
<h2>Dozent*in: <?php echo $arr['givenName'].' '.$arr['familyName']; ?>  bearbeiten</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <input name="familyName" type="text" value="<?php echo $arr['familyName']; ?>"/></p>
    <p>Vorname: <input name="givenName" type="text" value="<?php echo $arr['givenName']; ?>" /></p>
    <p>Titel: <input name="honorificPrefix" type="text" value="<?php echo $arr['honorificPrefix']; ?>" /></p>
    <p>E-Mail: <input name="email" type="text" value="<?php echo $arr['email']; ?>" /></p>
    <p>Deputatsstunden: <input name="contractualHours" type="text" value="<?php echo $arr['contractualHours']; ?>" /></p>
    <p>Minderungsstunden: <input name="reductingHours" type="text" value="<?php echo $arr['reductingHours']; ?>" /></p>
    <input type='hidden' name="id" value="<?php echo $id; ?>" />
    <input type='hidden' name="model" value="ip" />
    <input type='hidden' name="controller" value="ip" />
    <input type='hidden' name="action" value="update" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
  </form>
</div>
<?php } ?>