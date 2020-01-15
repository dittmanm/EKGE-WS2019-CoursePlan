<?php
  global $request;
  $cp = new CoursPlan();
  $main = new Main();
  $sp = new StudyProgram();
  $s = $request['sp'];
?>
<form action="index.php">
  <select name="sp" size="1">
    <option value="wi_ba" <?php echo $s === 'wi_ba' ? 'selected' : ''; ?>>WI BA</option>
    <option value="wi_ma" <?php echo $s === 'wi_ma' ? 'selected' : ''; ?>>WI MA</option>
    <option value="bwl_ba" <?php echo $s === 'bwl_ba' ? 'selected' : ''; ?>>BWL BA</option>
    <option value="bwl_ma" <?php echo $s === 'bwl_ma' ? 'selected' : ''; ?>>BWL MA</option>
    <option value="secm_ma" <?php echo $s === 'secm_ma' ? 'selected' : ''; ?>>Secm MA</option>
  </select> 
  <input type='hidden' name="model" value="ip" />
  <input type='hidden' name="controller" value="mp" />
  <p><input value="SPEICHERN" name="button" type="submit"></p>
</form>
  
<?php
  $splsit = $main->queryAction($sp->filterAction('cp:'.$request['sp']));
  foreach($splsit as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
  
  $list1 = $main->queryAction($cp->valuesAction('\'1. Semester\' cp:'.$request['sp']));
?>
<h3>1. Semester</h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
  <?php  
  foreach($list1 as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '</tr>';
  }
  ?>
</table>
<?php
  $list2 = $main->queryAction($cp->valuesAction('\'2. Semester\' cp:'.$request['sp']));
?>
<h3>2. Semester</h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
  <?php  
  foreach($list2 as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '</tr>';
  }
  ?>
</table>
<?php
  $list3 = $main->queryAction($cp->valuesAction('\'3. Semester\' cp:'.$request['sp']));
?>
<h3>3. Semester</h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
  <?php  
  foreach($list3 as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '</tr>';
  }
  ?>
</table>
<?php
  $list4 = $main->queryAction($cp->valuesAction('\'4. Semester\' cp:'.$request['sp']));
?>
<h3>4. Semester</h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
  <?php  
  foreach($list4 as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '</tr>';
  }
  ?>
</table>
<?php
  $list5 = $main->queryAction($cp->valuesAction('\'5. Semester\' cp:'.$request['sp']));
?>
<h3>5. Semester</h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th></tr>
  <?php  
  foreach($list5 as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '</tr>';
  }
  ?>
</table>