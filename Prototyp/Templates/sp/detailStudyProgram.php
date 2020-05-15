<?php
  global $request;

  if ($request['s_login'] == 1) {
    $sp = new StudyProgram();
    $main = new Main();
    $list = $main->queryAction($sp->filterAction($request["id"]));
    foreach ($list as $arr) {
  ?>
  <h2>Studiengang: <?php echo $arr['name']; ?>  löschen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <?php echo $arr['name']; ?></p>
      <p>Abschluss: <?php echo $arr['educationalCredentialAwarded']; ?></p>
      <?php 
      $pr = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['provider']); 
      if ($pr === 'wirtschaft') { echo '<p>Fachbereich: Wirtschaft</p>'; }
      elseif ($pr === 'informatik') { echo '<p>Fachbereich: Informatik</p>'; }
      ?>
      <input type='hidden' name="id" value="<?php echo str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']); ?>" />
      <input type='hidden' name="model" value="sp" />
      <input type='hidden' name="controller" value="sp" />
      <input type='hidden' name="action" value="delete" />
      <p><input value="BESTÄTIGEN" type="submit"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>