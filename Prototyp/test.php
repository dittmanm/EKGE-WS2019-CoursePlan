<?php
    session_start();
    $request = array_merge($_GET, $_POST);
    include_once("Controller/function.php");

    $main = new Main();
    $main->checkSession('s_season');
    $s_season = $main->getSession('s_season');
    $s_login = $main->getSession('s_login');
    
    // if (isset($request['action'])) {
    //   if ($request['action'] === 'create') {
    //     //$main = new Main();
    //     $main->createUser($request['username'], $request['password']);
    //     $data = 'Anlegen eines neuen Benutzers erfolgreich.';
    //   }
    //   if ($request['action'] === 'login') {
    //     echo 'checkUser: '.$main->checkUser($request['username'], $request['password']);
    //   }
    // }

    $data = 'Bitte geben Sie Ihr Benutzername und Passwort ein.';
    if (isset($_SESSION['s_username'])) 
    {$data = 'Herzlich Willkommen '.$_SESSION['s_username'];}
    
    //print_r($s_login);
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
<h2>Register</h2>
<div class="new">
  <form method="POST">
    <p>Benutzername: <input name="username" type="text" /></p>
    <p>Passwort: <input name="password" type="text" /></p>
    <!--<input type='hidden' name="model" value="login" />-->
    <!--<input type='hidden' name="controller" value="login" />-->
    <input type='hidden' name="action" value="create" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
  </form>
</div>

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