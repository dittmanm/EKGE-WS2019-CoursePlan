<?php
  $person = new InstructorPerson();
  $main = new Main();
  global $request;
  if($request['action'] === 'create') {
    if(($request['givenname'] != NULL) && ($request['familyname'] != NULL)) {
      $res = $main->updateAction($person->insertAction());
      echo 'RESULT: ';
      print_r($res);
    }
  }
  $list = $main->queryAction($person->listAction());
?>
<h2>Dozenten Planung</h2>
<table>
  <tr><th></th><th>Dozenten</th> <th>Dep.</th><th>Mind.</th><th>E-Mail</th><th></th><th></th></tr>
  <?php foreach($list as $arr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
    echo '<tr><td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.$arr['givenName'].' '.$arr['familyName'].'</td>';
    echo '<td>'.$arr['contructualHours'].'</td>';
    echo '<td>'.$arr['reductingHours'].'</td>';
    echo '<td>'.$arr['email'].'</td>';
    echo '<td><img src="images/edit-icon.png" width="15px" /></td>';
    echo '<td><img src="images/dele-icon.png" width="15px" /></td></tr>';
    }
  ?>
</table>
<p><a href="?model=ip&controller=newProf">Neuer Lehrbeauftragter</a></p>