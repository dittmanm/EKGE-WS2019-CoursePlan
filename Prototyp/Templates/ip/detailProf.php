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
  <h2>Dozent*in löschen</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Kürzel: <?php echo $id; ?></p>
      <p>Name: <?php echo $arr['familyName']; ?></p>
      <p>Vorname: <?php echo $arr['givenName']; ?></p>
      <p>Titel: <?php echo $arr['honorificPrefix']; ?></p>
      <p>E-Mail: <?php echo $arr['email']; ?></p>
      <p>Deputatsstunden: <?php echo $arr['contractualHours']; ?></p>
      <p>Minderungsstunden: <?php echo $arr['reductingHours']; ?></p>
      <p>Kollegium: 
      <?php
        if (isset($arr['memberOf'])) {
          $ctlist = $main->queryAction($ct->filterAction(str_replace('https://bmake.th-brandenburg.de/cp/', 'cp:', $arr['memberOf'])));
          foreach ($ctlist as $Marr) { echo $Marr['name']; }
        }
        ?>
      </p>
      <input type='hidden' name="id" value="<?php echo $id; ?>" />
      <input type='hidden' name="model" value="ip" />
      <input type='hidden' name="controller" value="ip" />
      <input type='hidden' name="action" value="delete" />
      <p><input value="BESTÄTIGEN" type="submit"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>