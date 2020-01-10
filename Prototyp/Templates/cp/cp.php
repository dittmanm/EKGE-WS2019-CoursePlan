<?php
  global $request;
  if ($request['season'] === '1S') {$text = '1. Semester';}
  elseif ($request['season'] === '2S') {$text = '2. Semester';}
  elseif ($request['season'] === '3S') {$text = '3. Semester';}
  elseif ($request['season'] === '4S') {$text = '4. Semester';}
  elseif ($request['season'] === '5S') {$text = '5. Semester';}
  $values = '\''.$text.'\' cp:'.$request['sp'];
  $cp = new CoursPlan();
  $dataCp = $cp->valuesAction($values);
  $main = new Main();
  $list = $main->queryAction($dataCp);
  $sp = new StudyProgram();
  $dataSp = $sp->filterAction('cp:'.$request['sp']);
  $splsit = $main->queryAction($dataSp);
  foreach($splsit as $arr) {
    echo '<h2>'.$arr['name'].'</h2>';
  }
?>
<h3><?php echo $text; ?></h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th><th>Ist</th><th>Diff</th><th>Doz 1</th><th>SWS 1</th><th>Doz 2</th><th>SWS 2</th><th>Doz 3</th><th>SWS 3</th></tr>
  <?php  
  //print_r($list);
  foreach($list as $arr) {
    echo '<tr>';
    echo '<td><a href="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['id']).'"><img src="images/edit-icon.png" width="15px" /></a></td>';
    echo '<td>'.$arr['name'].'</td>';
    echo '<td>'.$arr['timeRequired'].'</td>';
    echo '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
    echo '</tr>';
  }
  ?>
</table>

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
</div>