<?php
  global $request;
  $person = new ModulPlan();
  $main = new Main();
  $list = $main->queryAction($person->filterAction('cp:'.$request["id"]));
  foreach ($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
?>
<h2>Modul: <?php echo $arr['givenName'].' '.$arr['familyName']; ?>  löschen</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <?php echo $arr['Name']; ?></p>
    <p>SWS: <?php echo $arr['timeRequired']; ?></p>
    <p>Semester: <?php echo $arr['semesterSeason']; ?></p>
    <?php
    $splsit = $main->queryAction($sp->filterAction('cp:'.$request['isPartOf']));
    foreach($splsit as $sparr) { $ipo = $sparr['name']; }
    ?>
    <p>Studiengang: <?php echo $ipo; ?></p>
    <p>Findet statt im: <?php echo $arr['startDate']; ?></p>
    <input type='hidden' name="id" value="<?php echo $id; ?>" />
    <input type='hidden' name="model" value="mp" />
    <input type='hidden' name="controller" value="mp" />
    <input type='hidden' name="action" value="delete" />
    <p><input value="BESTÄTIGEN" name="button" type="submit"></p>
  </form>
</div>
<?php } ?>
