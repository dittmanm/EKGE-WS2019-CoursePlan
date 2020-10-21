<?php
  $person = new InstructorPerson();
  $ct = new College();
  $main = new Main();
  global $request;

  if($request['action'] === 'create') {
    $main->updateAction($person->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($person->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $res = $main->updateAction($person->deleteAction($datArr));
    }
    $main->updateAction($person->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($person->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $res = $main->updateAction($person->deleteAction($datArr));
    }
  }
  
  $list = $main->queryAction($person->listAction());
?>

<h2>Dozent*innen-Planung</h2>
<table>
  <tr><th>Titel</th><th>Name</th> <th>Dep.</th><th>Mind.</th><th>Kolleguim</th></tr>
  <?php foreach($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
    echo '<tr>';
    echo '<td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.$arr['givenName'].' '.$arr['familyName'].'</td>';
    echo '<td>'.$arr['contractualHours'].'</td>';
    echo '<td>'.$arr['reductingHours'].'</td>';
    if (isset($arr['memberOf']) && $arr['memberOf'] != '' ) {
      $ctlist = $main->queryAction($ct->filterAction(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['memberOf'])));
      foreach ($ctlist as $Marr) { echo '<td>'.$Marr['name'].'</td>'; }
    } else echo '<td></td>';
    if ($request['s_login'] == 1) {
      echo '<td><a href="?model=ip&controller=editProf&id='.$id.'"><img src="images/edit-icon.png" width="15px" /></a></td>';
      echo '<td><a href="?model=ip&controller=detailProf&id='.$id.'"><img src="images/dele-icon.png" width="15px" /></a></td>';
    }
    echo '</tr>';
    }
  ?>
</table>
<?php 
  if ($request['s_login'] == 1) {
    echo '<p><a href="?model=ip&controller=newProf">Neue/r Dozent*in</a></p>';
  }
?>