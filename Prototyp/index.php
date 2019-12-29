<?php
  $request = array_merge($_GET, $_POST);
  
  include_once("Controller/content.php");
  //include_once("Controller/db.php");
  //include_once("Controller/function.php");
  include_once("Controller/layout.php");
  
  $layout = new Layout();
  $content = new Content();

  error_reporting(0);
?>
<html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="Data/screen.css" media="all">
      <title><?php $title = $layout->getHeaderInfo(); echo $title; ?></title>
    </head>
    <body>
      <div id="main">
        <div id="header">
          <div class="logo left" style="width: 200px;">
            <a href="index.php">
              <?php $logo = $layout->getLogo(); echo $logo; ?></div>
            </a>
          <div class="login-menu right"><?php $loginmenu = $layout->getLoginMenu($session); echo $loginmenu; ?></div>
          <div class="headline left"><h1><?php $name = $layout->getName(); echo $name; ?></h1></div>
        </div>
        <div id="menu">
          <div class="first-menu"><?php $menu = $layout->getMenu($session); echo $menu; ?></div>
        </div>
        <div id="content">
          <div class="section">
          	<?php if($request['controller'] === 'login') {
								if ($result) {echo '<div class="result">'.$result.'</div>';}
							} ?>
            <?php $main = $content->display($request); echo $main; ?>
          </div>
        </div>
        <div id="footer">&nbsp;</div>
      </div>
      <!--<script src="Data/jquery-1.11.1.min.js" type="text/javascript"></script>-->
      <!--<script src="Data/app.js" type="text/javascript"></script>-->
    </body>
</html>