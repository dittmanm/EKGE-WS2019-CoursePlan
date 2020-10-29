<?php
  global $request;
  if ($request['s_login'] == 1) {
    $sp = new StudyProgram();
    $main = new Main();
?>
  <h2>Modul anlegen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" /></p>
      <p>SWS: <input name="timeRequired" type="text" /></p>
      <p>Semester:
        <select name="semesterSeason" size="1">
          <option value="WS">WiSe</option>
          <option value="SS">SoSe</option>
        </select>
      </p>
      <p>Studiengang:
      <?php $ipo = $request['sp']; ?>
      <select name="isPartOf" size="1">
          <?php 
          $sps = $main->queryAction($sp->getStudyPrograms());
          foreach ($sps as $SParr) {
            echo '<option value="'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $SParr['id']).'" >'.$SParr['name'].'</option>';
          }
          ?>
        </select>
      </p>
      <p>Findet statt im:
        <select name="startDate" size="1">
          <option value="1. Semester">1. Semester</option>
          <option value="2. Semester">2. Semester</option>
          <option value="3. Semester">3. Semester</option>
          <option value="4. Semester">4. Semester</option>
          <option value="5. Semester">5. Semester</option>
        </select>
      </p>
      <input type='hidden' name="model" value="mp" />
      <input type='hidden' name="controller" value="mp" />
      <input type='hidden' name="action" value="create" />
      <input type='hidden' name="sp" value="<?php echo $request['sp']; ?>" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php } else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; } ?>