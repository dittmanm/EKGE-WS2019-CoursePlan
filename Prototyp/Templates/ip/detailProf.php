<?php
  global $request;
  $person = new InstructorPerson();
  $main = new Main();
  $list = $main->queryAction($person->filterAction('cp:'.$request["id"]));
  foreach ($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
?>
<h2>Lehrbauftragten: <?php echo $arr['givenName'].' '.$arr['familyName']; ?>  löschen</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <?php echo $arr['familyName']; ?>"</p>
    <p>Vorname: <?php echo $arr['givenName']; ?>"</p>
    <p>honorificPrefix: <?php echo $arr['honorificPrefix']; ?>"</p>
    <p>E-Mail: <?php echo $arr['email']; ?>"</p>
    <p>Deputatsstunden: <?php echo $arr['contructualHours']; ?>"</p>
    <p>Minderungsstunden: <?php echo $arr['reductingHours']; ?>"</p>
    <input type='hidden' name="id" value="<?php echo $id; ?>" />
    <input type='hidden' name="model" value="ip" />
    <input type='hidden' name="controller" value="ip" />
    <input type='hidden' name="action" value="delete" />
    <p><input value="BESTÄTIGEN" name="button" type="submit"></p>
  </form>
</div>
<?php } ?>