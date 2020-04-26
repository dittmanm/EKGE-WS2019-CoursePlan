<?php
  $table = "login";
  $id = 1;
?>
<h2>Logout</h2>
<div class="logout form">
  <form action="index.php">
    <input type='hidden' name="model" value="<?php echo $table; ?>" />
    <input type='hidden' name="controller" value="login" />
    <input type='hidden' name="action" value="logout" />
    <p><input value="ABMELDEN" name="button" type="submit"></p>
  </form>
</div>