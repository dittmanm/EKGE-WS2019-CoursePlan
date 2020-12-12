<?php
  global $request;
  //print_r($request);
  $sp = new StudyProgram();
  $main = new Main();
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['name']);
    $main->updateAction($sp->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($sp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $datArr['provider'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['provider']);
      $main->updateAction($sp->deleteAction($datArr));
    }
    $main->updateAction($sp->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($sp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $datArr['provider'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['provider']);
      $main->updateAction($sp->deleteAction($datArr));
    }
  }
  if ($request['s_login'] == 1) {
    echo '<p><a href="?model=sp&controller=newStudyProgram">Neuer Studiengang</a></p>';
  }
  $splist = $main->queryAction($sp->listAction());
?>
<h2>Verwaltung der Studiengänge</h2>
<table>
  <tr><th>Studiengang</th><th>Kollegium</th><th>Abschluss</th></tr>
  <?php
    foreach($splist as $arr) {
      echo '<tr>';
      echo '<td>'.$arr['name'].'</td>';
      echo '<td>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['pname']).'</td>';
      echo '<td>'.$arr['educationalCredentialAwarded'].'</td>';
      if ($request['s_login'] == 1) {
        echo '<td><a href="?model=sp&controller=editStudyProgram&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
        echo '<td><a href="?model=sp&controller=detailStudyProgram&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/dele-icon.png" width="15px" /></a></td>';
      }
      echo '</tr>';
    } ?>
</table>