<?php
  global $request;
  $cp = new CoursPlan();
  $ip = new InstructorPerson();
  $main = new Main();
  $cplist = $main->queryAction($cp->filterAction('cp:'.$request['id']));
  $iplist = $main->queryAction($ip->listAction());
  foreach ($cplist as $CParr) {
    $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $CParr['id']);
?>
<h2>Modul-Instanz bearbeiten </h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Dozent*in:
      <select name="instructor" size="1">
<?php
    $iId = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $CParr['instructor']);
    foreach ($iplist as $Iarr) {
      $pid = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']);
      echo '<option value="'.$pid.'" ';
      echo $pid === $iId ? 'selected >' : '>';
      echo $Iarr['givenName'].' '.$Iarr['familyName'].'</option>';
    }
?>
      </select>
    </p>
    <p>SWS: <input name="courseWorkloadi" type="text" value="<?php echo $CParr['courseWorkloadi']; ?>"/></p>
    <p>Mitwirkende*r:
      <select name="contributor" size="1">
        <option value="cp:">ohne Unterstützung</option>
<?php
    $cId = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $CParr['contributor']);
    foreach ($iplist as $Iarr) {
      $pid = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']);
      echo '<option value="'.$pid.'" ';
      echo $pid === $cId ? 'selected >' : '>';
      echo $Iarr['givenName'].' '.$Iarr['familyName'].'</option>';
    }
?>        
      </select>
    </p>
    <p>SWS: <input name="courseWorkloadc" type="text" value="<?php echo $CParr['courseWorkloadc']; ?>" /></p>
    <input type='hidden' name="id" value="<?php echo $id; ?>" />
    <input type='hidden' name="sp" value="<?php echo $request['sp']; ?>" />
    <input type='hidden' name="season" value="<?php echo $request['season']; ?>" />
    <input type='hidden' name="model" value="cp" />
    <input type='hidden' name="controller" value="cp" />
    <input type='hidden' name="action" value="update" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
    <p><input value="ZURÜCKSETZEN" name="button" type="reset"></p>
  </form>
</div>
<?php } ?>