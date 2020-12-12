<?php
  global $request;
  $ct = new College();
  $main = new Main();
  $res = $ct->checkAction($request);
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