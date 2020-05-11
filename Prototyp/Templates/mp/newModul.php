<?php
  global $request;
  if ($request['s_login'] == 1) {
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
          <option value="wi_ba" <?php echo $ipo === 'wi_ba' ? 'selected' : ''; ?>>WI BA</option>
          <option value="wi_ma" <?php echo $ipo === 'wi_ma' ? 'selected' : ''; ?>>WI MA</option>
          <option value="bwl_ba" <?php echo $ipo === 'bwl_ba' ? 'selected' : ''; ?>>BWL BA</option>
          <option value="bwl_ma" <?php echo $ipo === 'bwl_ma' ? 'selected' : ''; ?>>BWL MA</option>
          <option value="secm_ma" <?php echo $ipo === 'secm_ma' ? 'selected' : ''; ?>>Secm MA</option>
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