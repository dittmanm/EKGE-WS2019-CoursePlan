<?php
  global $request;
  $mp = new ModulPlan();
  $main = new Main();
  $sp = new StudyProgram();
  $s = $request['sp'];
?>
<p><a href="?model=mp&controller=newModul">Neues Modul</a></p>
<form action="index.php">
  <select name="sp" size="1">
    <option value="wi_ba" <?php echo $s === 'wi_ba' ? 'selected' : ''; ?>>WI BA</option>
    <option value="wi_ma" <?php echo $s === 'wi_ma' ? 'selected' : ''; ?>>WI MA</option>
    <option value="bwl_ba" <?php echo $s === 'bwl_ba' ? 'selected' : ''; ?>>BWL BA</option>
    <option value="bwl_ma" <?php echo $s === 'bwl_ma' ? 'selected' : ''; ?>>BWL MA</option>
    <option value="secm_ma" <?php echo $s === 'secm_ma' ? 'selected' : ''; ?>>Secm MA</option>
  </select> 
  <input type='hidden' name="model" value="mp" />
  <input type='hidden' name="controller" value="mp" />
  <p><input value="SPEICHERN" name="button" type="submit"></p>
</form>
<?php
  $splsit = $main->queryAction($mp->filterAction('cp:'.$request['sp']));
  foreach($splsit as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
  for($i=1; $i < 6; $i++) {
    $list = $main->queryAction($cp->valuesAction('\''.$i.'. Semester\' cp:'.$request['sp']));
    if(isset($list)) {
      echo '<h3>'.$i.'. Semester</h3>';
    ?>
    <table>
      <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
      <?php
        foreach($list as $arr) {
          echo '<tr>';
          echo '<td><a href="?model=mp&controller=editModul&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
          echo '<td>'.$arr['name'].'</td>';
          echo '<td>'.$arr['timeRequired'].'</td>';
          echo '</tr>';
        } ?>
    </table>
  <?php }}
  