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
  <h2>Modul: <?php echo $arr['name']; ?>  bearbeiten</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" value="<?php echo $arr['name']; ?>" /></p>
      <p>SWS: <input name="timeRequired" type="text" value="<?php echo $arr['timeRequired']; ?>" /></p>
      <p>Semester:
      <?php $ss = $arr['semesterSeason']; ?>
        <select name="semesterSeason" size="1">
          <option value="WS" <?php echo $ss === 'WS' ? 'selected' : ''; ?>>WiSe</option>
          <option value="SS" <?php echo $ss === 'SS' ? 'selected' : ''; ?>>SoSe</option>
        </select>
      </p>
      <p>Studiengang:
      <?php $ipo = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['isPartOf']); ?>
        <select name="isPartOf" size="1">
          <?php 
          $sps = $main->queryAction($sp->getStudyPrograms());
          foreach ($sps as $SParr) {
            $spId = str_replace('https://bmake.th-brandenburg.de/cp/', '', $SParr['id']);
            echo '<option value="'.$spId.'" ';
            echo $request['sp'] === $spId ? 'selected' : '';
            echo '>'.$SParr['name'].'</option>';
          }
          ?>
        </select>
      </p>
      <p>Findet statt im:
      <?php $sd = $arr['startDate']; ?>
        <select name="startDate" size="1">
          <option value="1. Semester" <?php echo $sd === '1. Semester' ? 'selected' : ''; ?>>1. Semester</option>
          <option value="2. Semester" <?php echo $sd === '2. Semester' ? 'selected' : ''; ?>>2. Semester</option>
          <option value="3. Semester" <?php echo $sd === '3. Semester' ? 'selected' : ''; ?>>3. Semester</option>
          <option value="4. Semester" <?php echo $sd === '4. Semester' ? 'selected' : ''; ?>>4. Semester</option>
          <option value="5. Semester" <?php echo $sd === '5. Semester' ? 'selected' : ''; ?>>5. Semester</option>
        </select>
      </p>
      <input type='hidden' name="id" value="<?php echo $id; ?>" />
      <input type='hidden' name="model" value="mp" />
      <input type='hidden' name="controller" value="mp" />
      <input type='hidden' name="action" value="update" />
      <input type='hidden' name="sp" value="<?php echo $ipo; ?>" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>