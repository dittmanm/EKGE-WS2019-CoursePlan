<?php
global $request;
$ip = new InstructorPerson();
$main = new Main();
?>
<h2>Modul-Instanz anlegen </h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Dozent*in:
      <select name="instructor" size="1">
<?php
    $iplist = $main->queryAction($ip->listAction());
    foreach ($iplist as $Iarr) {
      echo '<option value="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']).'">';
      echo $Iarr['givenName'].' '.$Iarr['familyName'].'</option>';
    }
?>
      </select>
    </p>
    <p>SWS: <input name="courseWorkloadi" type="text" value="0"/></p>
    <p>Mitwirkende*r:
      <select name="contributor" size="1">
        <option value="">ohne Unterstützung</option>
<?php
    foreach ($iplist as $Iarr) {
      echo '<option value="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $Iarr['id']).'">';
      echo $Iarr['givenName'].' '.$Iarr['familyName'].'</option>';
    }
?>        
      </select>
    </p>
    <p>SWS: <input name="courseWorkloadc" type="text" value="0" /></p>
    <input type='hidden' name="hCi" value="<?php echo $request['hCi']; ?>" />
    <input type='hidden' name="model" value="cp" />
    <input type='hidden' name="controller" value="cp" />
    <input type='hidden' name="action" value="create" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
    <p><input value="ZURÜCKSETZEN" name="button" type="reset"></p>
  </form>
</div>