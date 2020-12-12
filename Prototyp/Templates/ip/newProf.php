<?php
global $request;
if ($request['s_login'] == 1) {
  $ct = new College();
  $main = new Main();
?>
  <h2>Dozent*in anlegen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input id="fn" name="familyName" type="text" /></p>
      <p>Vorname: <input id="gn" name="givenName" type="text" /></p>
      <p>Kürzel: <input id="id" name="id" type="text" /></p>
      <p id="idhint" class="error" style="display:none">Das Kürzel ist schon vergeben. Bitte wählen Sie ein anderes.</p>
      <p>Titel: <input name="honorificPrefix" type="text" /></p>
      <p>E-Mail: <input name="email" type="text" /></p>
      <p>Deputatsstunden: <input name="contractualHours" type="text" /></p>
      <p>Minderungsstunden: <input name="reductingHours" type="text" /></p>
      <p class="hint">Für eine Mehrfach-Auswahl bei den Kollegien halten Sie bitte die "Strg" Taste bei gleichzeitigem Anklicken der gewünschten Listeneinträge.</p>
      <?php
        $ctlist = $main->queryAction($ct->listAction());
        echo '<p>Kollegium: <select class="profSelect" name="memberOf[]" size="'.count($ctlist).'" multiple>';
        foreach ($ctlist as $CTarr) {
          echo '<option value="'.str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $CTarr['id']).'" >'.$CTarr['name'].'</option>';
        }
        echo '</select></p>';
      ?>
      <input type='hidden' name="model" value="ip" />
      <input type='hidden' name="controller" value="ip" />
      <input type='hidden' name="action" value="create" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
  <script src="Data/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="Data/ip.js" type="text/javascript"></script>
<?php } else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; } ?>