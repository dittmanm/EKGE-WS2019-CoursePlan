<?php
if ( isset( $_GET['iPid'] ) ) {
    include_once("ipController.php");
    include_once("function.php");
    $person = new InstructorPerson();
    $result =  $person->checkId('cp:'.$_GET['iPid']);
    echo $result;
} elseif ( isset( $_GET['switchYear'] ) ) {
    
} else {
    $result = 99;
}


?>