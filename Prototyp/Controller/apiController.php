<?php
if ( isset( $_GET['iPid'] ) ) {
    include_once("ipController.php");
    include_once("function.php");
    $person = new InstructorPerson();
    $result =  $person->checkId('cp:'.$_GET['iPid']);
    echo $result;
} elseif ( isset( $_GET['s_year'] ) ) {
    session_start();
    $request = array_merge($_GET, $_POST);
    include_once("function.php");
    $main = new Main();
    $main->checkSession('s_year');
    $result = $main->getSession('s_year');
    echo $result;
} else {
    $result = 99;
    echo $result;
}


?>