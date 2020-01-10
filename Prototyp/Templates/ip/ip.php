<?php
  $person = new InstructorPerson();
  $data = $person->listAction();
  $main = new Main();
  $list = $main->queryAction($data);
?>
<h2>Dozenten Planung</h2>
<table>
  <tr><th></th><th>Dozenten</th> <th>Dep.</th><th>Mind.</th><th>E-Mail</th><th></th><th></th></tr>
  <?php foreach($list as $arr) {
    //print_r($arr);
    echo '<tr><td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.$arr['givenName'].' '.$arr['familyName'].'</td>';
    echo '<td>'.$arr['contructualHours'].'</td>';
    echo '<td>'.$arr['reductingHours'].'</td>';
    echo '<td>'.$arr['email'].'</td>';
    //echo '<td>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']).'</td>';
    echo '<td><img src="images/edit-icon.png" width="15px" /></td>';
    echo '<td>L</td></tr>';
    }
  ?>
</table>
<p><a href="?model=ip&controller=newProf">Neuer Lehrbeauftragter</a></p>