<?php
  $person = new InstructorPerson();
  $main = new Main();
  global $request;
  if($request['action'] === 'create') {
    echo 'create';
    $res = $main->updateAction($person->insertAction($request));
  } elseif($request['action'] === 'update') {
    echo 'update';
    //print_r($request);
    echo $request["id"];
    $delDat = $main->queryAction($person->filterAction($request["id"]));
    echo 'DELETE DATA: ';
    print_r($delDat);
    $res = $main->updateAction($person->deleteAction($delDat));
    echo 'REQUEST DATA: ';
    //print_r($request);
    //$res[] = $main->updateAction($person->updateAction($request));
  } elseif($request['action'] === 'delete') {
    echo 'delete';
    $res = $main->updateAction($person->deleteAction($request));
  }
  echo 'RESULT: '; print_r($res);
  $list = $main->queryAction($person->listAction());
?>
<h2>Dozenten Planung</h2>
<table>
  <tr><th></th><th>Dozenten</th> <th>Dep.</th><th>Mind.</th><th>E-Mail</th><th></th><th></th></tr>
  <?php foreach($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
    echo '<tr>';
    echo '<td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.$arr['givenName'].' '.$arr['familyName'].'</td>';
    echo '<td>'.$arr['contructualHours'].'</td>';
    echo '<td>'.$arr['reductingHours'].'</td>';
    echo '<td>'.$arr['email'].'</td>';
    echo '<td><a href="?model=ip&controller=editProf&id='.$id.'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td><a href="?model=ip&controller=detailProf&id='.$id.'"><img src="images/dele-icon.png" width="15px" /></a></td>';
    echo '</tr>';
    }
  ?>
</table>
<p><a href="?model=ip&controller=newProf">Neuer Lehrbeauftragter</a></p>