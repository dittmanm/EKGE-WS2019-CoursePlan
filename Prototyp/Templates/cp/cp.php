<?php
  global $request;
  if ($request['season'] === '1S') {$text = '1. Semester';}
  elseif ($request['season'] === '2S') {$text = '2. Semester';}
  elseif ($request['season'] === '3S') {$text = '3. Semester';}
  elseif ($request['season'] === '4S') {$text = '4. Semester';}
  elseif ($request['season'] === '5S') {$text = '5. Semester';}
  
  $cp = new CoursPlan();
  $sp = new StudyProgram();
  $mp = new ModulPlan();
  $ip = new InstructorPerson();
  $main = new Main();
  
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['cHi']);
    $res = $main->updateAction($cp->insertAction($request));
    $res = $main->updateAction($mp->insertInstanceAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($cp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $res = $main->updateAction($cp->deleteAction($datArr));
    }
    $res[] = $main->updateAction($cp->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($cp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $res = $main->updateAction($cp->deleteAction($datArr));
    }
  }
  
  $splsit = $main->queryAction($sp->filterAction('cp:'.$request['sp']));
  foreach($splsit as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
?>
<h3><?php echo $text; ?></h3>
<table>
  <tr><th>Module</th><th>Soll</th><th>Ist</th><th>Diff</th><th>Dozent*in</th><th>SWS</th><th>Mitwirkende</th><th>SWS</th><th>&nbsp;</th></tr>
  <?php
  $mplist = $main->queryAction($mp->valuesAction('\''.$text.'\' cp:'.$request['sp']));
  foreach($mplist as $Marr) {
    echo '<tr>';
    echo '<td>'.$Marr['name'].'</td>';
    echo '<td>'.$Marr['timeRequired'].'</td>';
    if (isset($Marr['hasCourseInstance'])) {
      $cplist = $main->queryAction($cp->filterAction(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Marr['hasCourseInstance'])));
      foreach ($cplist as $Carr) {
        $ist = $Carr['courseWorkloadi']+$Carr['courseWorkloadc'];
        $diff = $Marr['timeRequired']-$Carr['courseWorkloadi']-$Carr['courseWorkloadc'];
        echo '<td>'.$ist.'</td>';
        echo '<td>'.$diff.'</td>';
        echo '<td>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $Carr['instructor']).'</td>';
        echo '<td>'.$Carr['courseWorkloadi'].'</td>';
        echo '<td>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $Carr['contributor']).'</td>';
        echo '<td>'.$Carr['courseWorkloadc'].'</td>';
        echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=editInstance&id=', $Carr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    } } else {
      echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
      echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=newInstance&hCi=', $Marr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    }
    echo '</tr>';
  }
  ?>
</table>
<h4>Dozenten*innen Auslastung</h4>
<table>
  <tr><th>Dozent*in</th><th>Soll</th><th>Redu</th><th>Work</th><th>Diff</th></tr>
  <?php
  $iplist = $main->queryAction($ip->listAction());
  foreach ($iplist as $Iarr) {
    $workHours = 0;
    $datCH = $main->queryAction($ip->getContributorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
    foreach ($datCH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadc']; }
    $datIH = $main->queryAction($ip->getInstructorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
    foreach ($datIH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadi']; }
    $diffHours = $Iarr['contructualHours']-$Iarr['reductingHours']-$workHours;
    echo '<tr>';
    echo '<td>'.$Iarr['givenName'].' '.$Iarr['familyName'].'</td>';
    echo '<td>'.$Iarr['contructualHours'].'</td>';
    echo '<td>'.$Iarr['reductingHours'].'</td>';
    echo '<td>'.$workHours.'</td>';
    if ($diffHours === 0) { echo '<td bgcolor=green>'.$diffHours.'</td>'; }
    elseif ($diffHours < 0) { echo '<td bgcolor=red>'.$diffHours.'</td>'; }
    elseif ($diffHours > 0) { echo '<td bgcolor=yellow>'.$diffHours.'</td>'; }
    echo '</tr>';
  }
  ?>
</table>

<!--
<div id="workload">
  <div class="block"></div><div class="z0">0</div><div class="z5">5</div><div class="z10">10</div>
  <div class="z15">15</div><div class="z20">20</div><div class="z25">25</div>
  <div class="wp">
    <p>AJ</p>
    <div class="c100">
      <section class="dp" style="width: 40%;">10</section>
      <section class="vl" style="width: 20%;">5</section>
    </div>
  </div>
  <div class="wp">
    <p>VM</p>
    <div class="c100">
      <section class="dp" style="width: 20%;">5</section>
      <section class="vl" style="width: 60%;">15</section>
    </div>
  </div>
  <div class="wp">
    <p>JS</p>
    <div class="c100">
      <section class="dp" style="width: 40%;">10</section>
      <section class="vl" style="width: 40%;">10</section>
    </div>
  </div>
  <div class="wp">
    <p>KJ</p>
    <div class="c100">
      <section class="dp" style="width: 8%;">2</section>
      <section class="vl" style="width: 64%;">16</section>
    </div>
  </div>
  <div class="wp">
    <p>WP</p>
    <div class="c100">
      <section class="dp" style="width: 24%;">6</section>
      <section class="vl" style="width: 16%;">4</section>
    </div>
  </div>
  <div class="wp">
    <p>MH</p>
    <div class="c100">
      <section class="dp" style="width: 60%;">15</section>
      <section class="vl" style="width: 20%;">5</section>
    </div>
  </div>
</div>-->