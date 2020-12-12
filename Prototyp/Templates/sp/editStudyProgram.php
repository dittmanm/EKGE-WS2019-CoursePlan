<?php
  global $request;
  if ($request['s_login'] == 1) {
    $sp = new StudyProgram();
    $ct = new College();
    $main = new Main();
    $list = $main->queryAction($sp->filterAction($request["id"]));
    foreach ($list as $arr) {
  ?>
  <h2>Studiengang: <?php echo $arr['name']; ?>  bearbeiten</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" value="<?php echo $arr['name']; ?>" /></p>
      <?php $eca = $arr['educationalCredentialAwarded']; ?>
      <p>Abschluss:
        <select name="educationalCredentialAwarded" size="1">
          <option value="Bachelor" <?php echo $eca === 'Bachelor' ? 'selected' : ''; ?>>Bachelor</option>
          <option value="Master" <?php echo $eca === 'Master' ? 'selected' : ''; ?>>Master</option>
        </select>
      </p> 
      <p>Kollegium: <select name="provider" size="1">
        <?php
          $pr = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['provider']);
          $ctlist = $main->queryAction($ct->listAction());
          foreach ($ctlist as $datArr) {
            echo '<option value="'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']).'"';
            echo $pr == str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $datArr['id']) ? 'selected >' : '>';
            echo $datArr['name'].'</option>';
          }
        ?>
      </select></p>
      <input type='hidden' name="id" value="<?php echo str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']); ?>" />
      <input type='hidden' name="model" value="sp" />
      <input type='hidden' name="controller" value="sp" />
      <input type='hidden' name="action" value="update" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>