<?php
  global $request;
  if ($request['s_login'] == 1) {
    $mp = new ModulPlan();
    $sp = new StudyProgram();
    $main = new Main();
    $list = $main->queryAction($mp->detailAction($request["id"]));
    foreach ($list as $arr) {
      $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
  ?>
  <h2>Modul: <?php echo $arr['name']; ?>  löschen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <?php echo $arr['name']; ?></p>
      <p>SWS: <?php echo $arr['timeRequired']; ?></p>
      <p>Semester: <?php echo $arr['semesterSeason']; ?></p>
      <?php
      $ipo = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['isPartOf']);
      $splsit = $main->queryAction($sp->filterAction('cp:'.$ipo));
      foreach($splsit as $sparr) { $ipoName = $sparr['name']; }
      ?>
      <p>Studiengang: <?php echo $ipoName; ?></p>
      <!--<p>Studiengang: <?php echo $arr['isPartOf']; ?></p>-->
      <p>Findet statt im: <?php echo $arr['startDate']; ?></p>
      <input type='hidden' name="id" value="<?php echo $id; ?>" />
      <input type='hidden' name="model" value="mp" />
      <input type='hidden' name="controller" value="mp" />
      <input type='hidden' name="action" value="delete" />
      <input type='hidden' name="sp" value="<?php echo $ipo; ?>" />
      <p><input value="BESTÄTIGEN" type="submit"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>