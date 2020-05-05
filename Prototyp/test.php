<?php
    session_start();
    $request = array_merge($_GET, $_POST);
    include_once("Controller/function.php");

    $main = new Main();
    $main->checkSession('s_season');
    $s_season = $main->getSession('s_season');
    $s_login = $main->getSession('s_login');
    
    $data = 'Bitte geben Sie Ihr Benutzername und Passwort ein.';
    if (isset($_SESSION['s_username'])) 
    {$data = 'Herzlich Willkommen '.$_SESSION['s_username'];}
    
    print_r($s_login);
if ($s_login === 0) {
?>
<h2>Login</h2>
<div class="login form">
  <p><?php echo $data; ?></p>
  <form method="POST">
    <p>Benutzername: <input name="username" type="text" /></p>
    <p>Passwort: <input name="password" type="password" /></p>
    <!--<input type='hidden' name="model" value="login" />-->
    <!--<input type='hidden' name="controller" value="login" />-->
    <input type='hidden' name="action" value="login" />
    <p><input value="ANMELDEN" type="submit"></p>
  </form>
</div>
<?php } else { ?>
<h2>Logout</h2>
<div class="logout form">
  <p><?php echo $data; ?></p>
  <form method="POST">
    <!--<input type='hidden' name="model" value="login" />-->
    <!--<input type='hidden' name="controller" value="login" />-->
    <input type='hidden' name="action" value="logout" />
    <p><input value="ABMELDEN" type="submit"></p>
  </form>
</div>
<?php } ?>