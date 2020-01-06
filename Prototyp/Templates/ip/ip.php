<?php
  $person = new InstructorPerson();
  $data = $person->listAction();
  $main = new Main();
  $list = $main->queryAction($data);
?>
<h2>Dozenten Planung</h2>
<table>
  <tr><th>Dozenten</th> <th>Dep.</th> <th>Mind</th> <th></th><th></th></tr>
  <?php foreach($list as $arr) {
    //print_r($arr);
    echo '<tr><td>'.$arr['familyName'].', '.$arr['givenName'].'</td>';
    echo '<td>'.$arr['honorificPrefix'].'</td>';
    echo '<td>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']).'</td>';
    echo '<td>bearbeiten</td></tr>';
    echo '<td>löschen</td></tr>';
    }
  ?>
</table>
<p>
  <a href="?model=ip&controller=newProf">Neuer Lehrbeauftragter</a>
</p>