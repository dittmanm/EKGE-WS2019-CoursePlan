<?php
  $person = new InstructorPerson();
  $main = new Main();
  global $request;
  if($request['action'] === 'create') {
    $res = $main->updateAction($person->insertAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($person->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $res = $main->updateAction($person->deleteAction($datArr));
    }
    $res[] = $main->updateAction($person->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $res = $main->updateAction($person->deleteAction($request));
  }
  //echo 'RESULT: '; print_r($res);
  $list = $main->queryAction($person->listAction());
?>
<h2>Dozent*innen-Planung</h2>
<table>
  <tr><th></th><th>Name</th> <th>Dep.</th><th>Mind.</th><th></th><th></th></tr>
  <?php foreach($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
    echo '<tr>';
    echo '<td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.$arr['givenName'].' '.$arr['familyName'].'</td>';
    echo '<td>'.$arr['contructualHours'].'</td>';
    echo '<td>'.$arr['reductingHours'].'</td>';
    //echo '<td>'.$arr['email'].'</td>';
    echo '<td><a href="?model=ip&controller=editProf&id='.$id.'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td><a href="?model=ip&controller=detailProf&id='.$id.'"><img src="images/dele-icon.png" width="15px" /></a></td>';
    echo '</tr>';
    }
  ?>
</table>
<p><a href="?model=ip&controller=newProf">Neuer Dozent*in</a></p>