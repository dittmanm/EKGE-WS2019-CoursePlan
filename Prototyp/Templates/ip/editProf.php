<?php
  global $request;
  if ($request['s_login'] == 1) {
    $person = new InstructorPerson();
    $ct = new College();
    $main = new Main();
    $list = $main->queryAction($person->filterAction('cp:'.$request["id"]));
    foreach ($list as $arr) {
      $id = str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']);
  ?>
  <h2>Dozent*in: <?php echo $arr['givenName'].' '.$arr['familyName']; ?>  bearbeiten</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Kürzel: <input id="id" name="id" type="text" value="<?php echo $id; ?>"/></p>
      <p id="idhint" class="error" style="display:none">Das Kürzel ist schon vergeben. Bitte wählen Sie ein anderes.</p>
      <p>Name: <input id="fn" name="familyName" type="text" value="<?php echo $arr['familyName']; ?>"/></p>
      <p>Vorname: <input id="gn" name="givenName" type="text" value="<?php echo $arr['givenName']; ?>" /></p>
      <p>Titel: <input name="honorificPrefix" type="text" value="<?php echo $arr['honorificPrefix']; ?>" /></p>
      <p>E-Mail: <input name="email" type="text" value="<?php echo $arr['email']; ?>" /></p>
      <p>Deputatsstunden: <input name="contractualHours" type="text" value="<?php echo $arr['contractualHours']; ?>" /></p>
      <p>Minderungsstunden: <input name="reductingHours" type="text" value="<?php echo $arr['reductingHours']; ?>" /></p>
      <p class="hint">Für eine Mehrfach-Auswahl bei den Kollegien halten Sie bitte die "Strg" Taste bei gleichzeitigem Anklicken der gewünschten Listeneinträge.</p>
      <?php
        $molist = $main->queryAction($person->listPersonMemberOf('cp:'.$id));
        foreach ($molist as $MOarr) { $molistNew[] = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $MOarr['memberOf']); }
        $ctlist = $main->queryAction($ct->listAction());
        echo '<p>Kollegium: <select class="profSelect" name="memberOf[]" size="'.count($ctlist).'" multiple>';
        foreach ($ctlist as $CTarr) {
          $cId = str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $CTarr['id']);
          echo '<option value="'.$cId.'" ';
          echo in_array($cId, $molistNew) ? 'selected >' : '>';
          echo $CTarr['name'].'</option>';
        }
        echo '</select></p>';
      ?>
      <input type='hidden' name="model" value="ip" />
      <input type='hidden' name="controller" value="ip" />
      <input type='hidden' name="action" value="update" />
      <p><input value="SPEICHERN" type="submit"></p>
    </form>
  </div>
  <script src="Data/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="Data/ip.js" type="text/javascript"></script>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>