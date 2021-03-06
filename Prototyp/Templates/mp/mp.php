<?php
  global $request;
  $mp = new ModulPlan();
  $sp = new StudyProgram();
  $main = new Main();
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['name']);
    $main->updateAction($mp->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($mp->detailAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($mp->deleteAction($datArr));
    }
    $main->updateAction($mp->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($mp->detailAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($mp->deleteAction($datArr));
    }
  }
?>
<form action="index.php" class="modulPlan">
  <select id="sp" name="sp" size="1">
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
</form>
<?php
  if ($request['s_login'] == 1) {
    echo '<p><a href="?model=mp&controller=newModul&sp='.$request['sp'].'">Neues Modul</a></p>';
  }
  $splsit = $main->queryAction($sp->filterAction('cp:'.$request['sp']));
  foreach($splsit as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
  for($i=1; $i < 6; $i++) {
    $mplist = $main->queryAction($mp->valuesActionNew('\''.$i.'. Semester\' cp:'.$request['sp'], $request['s_year']));
    if(isset($mplist)) {
      echo '<h3>'.$i.'. Semester</h3>';
    ?>
    <table>
      <tr><th>Modul</th><th>SWS</th></tr>
      <?php
        foreach($mplist as $arr) {
          echo '<tr>';
          echo '<td>'.$arr['name'].'</td>';
          echo '<td>'.$arr['timeRequired'].'</td>';
          if ($request['s_login'] == 1) {
            echo '<td><a href="?model=mp&controller=editModul&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
            echo '<td><a href="?model=mp&controller=detailModul&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/dele-icon.png" width="15px" /></a></td>';
          }
          echo '</tr>';
        } ?>
    </table>
  <?php }}