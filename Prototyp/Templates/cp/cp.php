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
?>
<!--<form action="index.php">
  <input type='hidden' name="model" value="cp" />
  <input type='hidden' name="controller" value="cp" />
  <input type='hidden' name="sp" value="<?php echo $request['sp']; ?>" />
  <input type='hidden' name="season" value="<?php echo $request['season']; ?>" />
  <p><input value="REFRESH" name="button" type="submit" class="left"></p>
</form>-->
<?php
  $splsit = $main->queryAction($sp->filterAction('cp:'.$request['sp']));
  foreach($splsit as $arr) { echo '<h2>'.$arr['name'].'</h2>'; }
?>
<h3><?php echo $text; ?></h3>
<table>
  <tr><th>Modul</th><th>Soll</th><th>Ist</th><th>Diff</th><th>Dozent*in</th><th>SWS</th><th>Mitwirkende</th><th>SWS</th><th>&nbsp;</th></tr>
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
        echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=editInstance&sp='.$request['sp'].'&season='.$request['season'].'&id=', $Carr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    } } else {
      echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
      echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', '?model=cp&controller=newInstance&sp='.$request['sp'].'&season='.$request['season'].'&hCi=', $Marr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    }
    echo '</tr>';
  }
  ?>
</table>
<h4>Dozenten*innen Auslastung</h4>
<!--<table>
  <tr><th>Dozent*in</th><th>Soll</th><th>Dep</th><th>Work</th><th>Diff</th></tr>
  <?php
//  $iplist = $main->queryAction($ip->listAction());
//  foreach ($iplist as $Iarr) {
//    $workHours = 0;
//    $datCH = $main->queryAction($ip->getContributorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
//    foreach ($datCH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadc']; }
//    $datIH = $main->queryAction($ip->getInstructorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
//    foreach ($datIH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadi']; }
//    $diffHours = $Iarr['contructualHours']-$Iarr['reductingHours']-$workHours;
//    echo '<tr>';
//    echo '<td>'.$Iarr['givenName'].' '.$Iarr['familyName'].'</td>';
//    echo '<td>'.$Iarr['contructualHours'].'</td>';
//    echo '<td>'.$Iarr['reductingHours'].'</td>';
//    echo '<td>'.$workHours.'</td>';
//    if ($diffHours === 0) { echo '<td bgcolor=green>'.$diffHours.'</td>'; }
//    elseif ($diffHours < 0) { echo '<td bgcolor=red>'.$diffHours.'</td>'; }
//    elseif ($diffHours > 0) { echo '<td bgcolor=yellow>'.$diffHours.'</td>'; }
//    echo '</tr>';
//  }
  ?>
</table>-->

<div id="workload">
  <div class="block"></div><div class="z0">0</div><div class="z5">5</div><div class="z10">10</div>
  <div class="z15">15</div><div class="z20">20</div><div class="z25">25</div>
  <?php
  $iplist = $main->queryAction($ip->listAction());
  foreach ($iplist as $Iarr) {
    $workHours = 0;
    $datCH = $main->queryAction($ip->getContributorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
    foreach ($datCH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadc']; }
    $datIH = $main->queryAction($ip->getInstructorHours(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id'])));
    foreach ($datIH as $ipVal) { $workHours = $workHours + $ipVal['courseWorkloadi']; }
    $diffHours = $Iarr['contructualHours']-$Iarr['reductingHours']-$workHours;
    echo '<div class="wp">';
    echo '<p>'.str_replace('https://bmake.th-brandenburg.de/cp/', '', $Iarr['id']).'</p>';
    echo '<div class="c100">';
    $dep = (100 / $Iarr['contructualHours'] ) * $Iarr['reductingHours'] ;
    $work = (100 / $Iarr['contructualHours'] ) * $workHours ;
    echo '<section class="dp" style="width: '.$dep.'%;">'.$Iarr['reductingHours'].'</section>';
    echo '<section class="vl" style="width: '.$work.'%;">'.$workHours.'</section>';
    echo '</div></div>';
  }
  ?> 
</div>