<?php
  //global $request;
  //$season = $request['season'];
  $season = $_GET['season'];
  if ($season === '1S') {$text = '1. Semester';}
  elseif ($season === '2S') {$text = '2. Semester';}
  elseif ($season === '3S') {$text = '3. Semester';}
  elseif ($season === '4S') {$text = '4. Semester';}
  elseif ($season === '5S') {$text = '5. Semester';}
?>
<h2>Wirtschaftsinformatik Bachelor</h2>
<h3><?php echo $text; ?></h3>
<table>
  <tr><th>&nbsp;</th><th>Module</th><th>Soll</th><th>Ist</th><th>Diff</th><th>Doz 1</th><th>SWS 1</th><th>Doz 2</th><th>SWS 2</th><th>Doz 3</th><th>SWS 3</th></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Grundlagen stat. Methoden</td><td>6</td><td>6</td><td>0</td><td>AJ</td><td>6</td><td></td><td></td><td></td><td></td></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Grundlagen der Proz. Modellierung</td><td>8</td><td>8</td><td>0</td><td>VM</td><td>4</td><td></td><td></td><td></td><td></td></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Rechnungswesen + Controlling</td><td>4</td><td>2</td><td>-2</td><td>JS</td><td>6</td><td></td><td></td><td></td><td></td></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Objektorientierter Systementwurf</td><td>8</td><td>8</td><td>0</td><td>WP</td><td>4</td><td></td><td></td><td></td><td></td></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Englisch anwenden WI</td><td>6</td><td>6</td><td>0</td><td>RF</td><td>4</td><td></td><td></td><td></td><td></td></tr>
  <tr><td><a href=""><img src="images/edit-icon.png" width="15px" /></a></td><td>Datenbanken - Modell + Struktur</td><td>8</td><td>3</td><td>-5</td><td>MH</td><td>2</td><td></td><td></td><td></td><td></td></tr>
</table>
<div id="workload">
  <div class="block"></div>
  <div class="z0">0</div>
  <div class="z5">5</div>
  <div class="z10">10</div>
  <div class="z15">15</div>
  <div class="z20">20</div>
  <div class="z25">25</div>
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