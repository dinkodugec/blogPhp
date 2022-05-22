
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>


<?php

$_SESSION["userId"]=null;
$_SESSION["username"]=null;
$_SESSION["adminName"]=null;
session_destroy();
redirectTo("login.php")


?>