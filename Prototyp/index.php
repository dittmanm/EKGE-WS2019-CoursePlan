<?php
  session_start();
  $request = array_merge($_GET, $_POST);

  include_once("Controller/ipController.php");
  include_once("Controller/cpController.php");
  include_once("Controller/spController.php");
  include_once("Controller/mpController.php");
  include_once("Controller/content.php");
  include_once("Controller/function.php");
  include_once("Controller/layout.php");

  $layout = new Layout();
  $content = new Content();
  $main = new Main();
  $main->checkSession();
	$session = $main->getSession();

  error_reporting(0);
?>
<html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="Data/screen.css" media="all">
      <title><?php $title = $layout->getHeaderInfo(); echo $title; ?></title>
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
      <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    </head>
    <body>
      <div id="main">
        <div id="header">
          <div class="logo left" style="width: 200px;">
            <a href="index.php">
              <?php $logo = $layout->getLogo(); echo $logo; ?></div>
            </a>
          <div class="login-menu right"><?php //$loginmenu = $layout->getLoginMenu($session); //echo $loginmenu; ?></div>
          <div class="headline left"><h1><?php $name = $layout->getName(); echo $name; ?></h1></div>
        </div>
        <div id="menu">
          <form class="switchbtn">
            <button formmethod="post" name="session" value="SS">SS</button>
            <button formmethod="post" name="session" value="WS">WS</button>
          </form>
          <div class="first-menu"><?php $menu = $layout->getMenu($session); echo $menu; ?></div>
        </div>
        <div id="content">
          <div class="section">
          	<?php if($request['controller'] === 'login') {
								if ($result) {echo '<div class="result">'.$result.'</div>';}
							} ?>
            <?php $mainContent = $content->display($request); echo $mainContent; ?>
          </div>
        </div>
        <div id="footer">Developed by Coursplan-Group</div>
      </div>
      <!--<script src="Data/jquery-1.11.1.min.js" type="text/javascript"></script>-->
      <!--<script src="Data/app.js" type="text/javascript"></script>-->
    </body>
</html>
