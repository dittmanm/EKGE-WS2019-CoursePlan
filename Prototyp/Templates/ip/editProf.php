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
    <p>Kürzel: <input id="id" name="id" type="text" value="<?php echo $id; ?>"/></p>
    <p>Name: <input id="fn" name="familyName" type="text" value="<?php echo $arr['familyName']; ?>"/></p>
    <p>Vorname: <input id="gn" name="givenName" type="text" value="<?php echo $arr['givenName']; ?>" /></p>
    <p>Titel: <input name="honorificPrefix" type="text" value="<?php echo $arr['honorificPrefix']; ?>" /></p>
    <p>E-Mail: <input name="email" type="text" value="<?php echo $arr['email']; ?>" /></p>
    <p>Deputatsstunden: <input name="contractualHours" type="text" value="<?php echo $arr['contractualHours']; ?>" /></p>
    <p>Minderungsstunden: <input name="reductingHours" type="text" value="<?php echo $arr['reductingHours']; ?>" /></p>
    <input type='hidden' name="model" value="ip" />
    <input type='hidden' name="controller" value="ip" />
    <input type='hidden' name="action" value="update" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
  </form>
</div>
<script src="Data/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="Data/ip.js" type="text/javascript"></script>
<?php } ?>