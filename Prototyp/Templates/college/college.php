<?php
  global $request;
  //print_r($request);
  $ct = new College();
  $main = new Main();
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['name']);
    $main->updateAction($ct->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($ct->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($ct->deleteAction($datArr));
    }
    $main->updateAction($ct->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($ct->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($ct->deleteAction($datArr));
    }
  }
  if ($request['s_login'] == 1) {
    echo '<p><a href="?model=college&controller=newCollege">Neues Kollegium</a></p>';
  }
  $ctlist = $main->queryAction($ct->listAction());
?>
<h2>Verwaltung der Kollegien</h2>
<table>
  <tr><th>Name</th></tr>
  <?php
    foreach($ctlist as $arr) {
      echo '<tr>';
      echo '<td>'.$arr['name'].'</td>';
      if ($request['s_login'] == 1) {
        echo '<td><a href="?model=college&controller=editCollege&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
        echo '<td><a href="?model=college&controller=detailCollege&id='.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/dele-icon.png" width="15px" /></a></td>';
      }
      echo '</tr>';
    } ?>
</table>