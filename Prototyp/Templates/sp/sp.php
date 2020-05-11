<?php
  global $request;
  $sp = new StudyProgram();
  $main = new Main();
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['name']);
    $main->updateAction($sp->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($mp->detailAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($sp->deleteAction($datArr));
    }
    $main->updateAction($sp->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($sp->detailAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($sp->deleteAction($datArr));
    }
  }
?>
<!-- cp:bwl_ba  a             cp:StudyProgram ;
        schema:educationalCredentialAwarded
                "Bachelor" ;
        schema:name      "BWL Bachelor" ;
        schema:provider  cp:wirtschaft . -->
<?php
  if ($request['s_login'] == 1) {
    echo '<p><a href="?model=sp&controller=newStudyProgram&provider='.$request['provider'].'">Neuer Studiengang</a></p>';
  }
?>
    <table>
      <tr><th>Studiengang</th><th>Fachbereich</th><th>&nbsp;</th><th>&nbsp;</th></tr>
      <?php
        foreach($splist as $arr) {
          echo '<tr>';
          echo '<td>'.$arr['name'].'</td>';
          echo '<td>'.$arr['provider'].'</td>';
          if ($request['s_login'] == 1) {
            echo '<td><a href="?model=sp&controller=editStudyProgram&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
            echo '<td><a href="?model=sp&controller=detailStudyProgram&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/dele-icon.png" width="15px" /></a></td>';
          }  else { echo '<td></td><td></td>'; }
          echo '</tr>';
        } ?>
    </table>
  <?php }}