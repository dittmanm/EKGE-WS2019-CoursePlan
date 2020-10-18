<?php
  global $request;
  if ($request['season'] === '1') {$text = '1. Semester';}
  elseif ($request['season'] === '2') {$text = '2. Semester';}
  elseif ($request['season'] === '3') {$text = '3. Semester';}
  elseif ($request['season'] === '4') {$text = '4. Semester';}
  elseif ($request['season'] === '5') {$text = '5. Semester';}
  
  $cp = new CoursPlan();
  $sp = new StudyProgram();
  $mp = new ModulPlan();
  $ip = new InstructorPerson();
  $main = new Main();
  $s_year = $main->getSession('s_year');
  
  if($request['action'] === 'create') {
    $request['id'] = $main->generateKey($request['hCi']);
    $main->updateAction($cp->insertAction($request));
    $main->updateAction($mp->insertInstanceAction($request));
  } elseif($request['action'] === 'update') {
    $delDat = $main->queryAction($cp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($cp->deleteAction($datArr));
    }
    $main->updateAction($cp->updateAction($request));
  } elseif($request['action'] === 'delete') {
    $delDat = $main->queryAction($cp->filterAction('cp:'.$request['id']));
    foreach($delDat as $datArr) {
      $datArr['id'] = str_replace('https://bmake.th-brandenburg.de/cp/', '', $datArr['id']);
      $main->updateAction($cp->deleteAction($datArr));
    }
  }
  $_POST['action'] = '';
?>

<?php
  $splist = $main->queryAction($sp->filterAction('cp:'.$request['sp']));
  foreach($splist as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
?>
<h3><?php echo $text; ?></h3>
<table>
  <tr><th>Modul</th><th>Soll</th><th>Ist</th><th>Diff</th><th>Dozent*in</th><th>SWS</th><th>Mitwirkende</th><th>SWS</th></tr>
  <?php
  $mplist = $main->queryAction($mp->valuesAction('\''.$text.'\' cp:'.$request['sp'], $s_year));
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
          if ($request['s_login'] == 1) {
            echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=editInstance&sp='.$request['sp'].'&season='.$request['season'].'&id=', $Carr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
          }
      }
    } else {
      echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
      if ($request['s_login'] == 1) {
        echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=newInstance&sp='.$request['sp'].'&season='.$request['season'].'&hCi=', $Marr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
      }
    }
    echo '</tr>';
  }
  ?>
</table>

<h4>Dozenten*innen Auslastung</h4>
<div id="workload">
  <div class="block"></div><div class="z0">0%</div><div class="z25">25%</div><div class="z50">50%</div>
  <div class="z75">75%</div><div class="z100">100%</div><div class="z125">125%</div>
  <?php
  $iplist = $main->queryAction($ip->listAction());
  foreach ($iplist as $Iarr) {
    echo '<div class="wp">';
    echo '<p>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $Iarr['id']).'</p>';
    echo '<div class="c100">';
    $workHours = 0;
    $datCH = $main->queryAction($ip->getContributorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']), $s_year));
    foreach ($datCH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadc']; }
    $datIH = $main->queryAction($ip->getInstructorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']), $s_year));
    foreach ($datIH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadi']; }
    $diffHours = $Iarr['contractualHours']-$Iarr['reductingHours']-$workHours;
    $dep = (100 / $Iarr['contractualHours'] ) * $Iarr['reductingHours'] *0.75 ;
    $work = (100 / $Iarr['contractualHours'] ) * $workHours *0.75 ;
    echo '<section class="dp" style="width: '.$dep.'%;">'.$Iarr['reductingHours'].'</section>';
    echo '<section class="vl" style="width: '.$work.'%;">'.$workHours.'</section>';
    echo '</div></div>';
  }
  ?> 
</div>