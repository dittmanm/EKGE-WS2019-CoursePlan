<?php
  global $request;
  if ($request['s_login'] == 1) {
    $ct = new College();
    $main = new Main();
    $list = $main->queryAction($ct->filterAction($request["id"]));
    foreach ($list as $arr) {
  ?>
  <h2>Kollegium: <?php echo $arr['name']; ?>  bearbeiten</h2>
  <div class="new">
    <form action="index.php" method="POST">
      <p>Name: <input name="name" type="text" value="<?php echo $arr['name']; ?>" /></p>
      <input type='hidden' name="id" value="<?php echo str_replace('https://bmake.th-brandenburg.de/cp/', '', $arr['id']); ?>" />
      <input type='hidden' name="model" value="college" />
      <input type='hidden' name="controller" value="college" />
      <input type='hidden' name="action" value="update" />
      <p><input value="SPEICHERN" type="submit"></p>
      <p><input value="ZURÜCKSETZEN" type="reset"></p>
    </form>
  </div>
<?php }
} else { echo '<p>Sie haben nicht die erforderlichen Berechtigungen um diese Seite zu sehen!'; }
?>