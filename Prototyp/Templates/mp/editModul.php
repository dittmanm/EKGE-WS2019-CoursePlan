<?php
  global $request;
  $person = new ModulPlan();
  $main = new Main();
  $list = $main->queryAction($person->filterAction($request["id"]));
  foreach ($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
?>
<h2>Modul: <?php echo $arr['Name']; ?>  bearbeiten</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <input name="name" type="text" /></p>
    <p>timeRequired: <input name="timeRequired" type="text" /></p>
    <p>Semester:
      <select name="semesterSeason" size="1">
        <option value="WiSe" <?php echo $ss === 'WiSe' ? 'selected' : ''; ?>>WiSe</option>
        <option value="SoSe" <?php echo $ss === 'SoSe' ? 'selected' : ''; ?>>SoSe</option>
      </select>
    </p>
    <p>isPartOf:
      <select name="isPartOf" size="1">
        <option value="wi_ba" <?php echo $ipo === 'wi_ba' ? 'selected' : ''; ?>>WI BA</option>
        <option value="wi_ma" <?php echo $ipo === 'wi_ma' ? 'selected' : ''; ?>>WI MA</option>
        <option value="bwl_ba" <?php echo $ipo === 'bwl_ba' ? 'selected' : ''; ?>>BWL BA</option>
        <option value="bwl_ma" <?php echo $ipo === 'bwl_ma' ? 'selected' : ''; ?>>BWL MA</option>
        <option value="secm_ma" <?php echo $ipo === 'secm_ma' ? 'selected' : ''; ?>>Secm MA</option>
      </select>
    </p>
    <p>startDate:
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
    <p><input value="SPEICHERN" name="button" type="submit"></p>
    <p><input value="ZURÜCKSETZEN" name="button" type="reset"></p>
  </form>
</div>
<?php } ?>