<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
    $_SESSION["User_IdVideo"]=null;
    session_destroy();
    Move_toVideo("index.php");
?>