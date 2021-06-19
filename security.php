<?php


include("admin/settings.php");

session_start();

if(!(isset($_SESSION["login"]) && $_SESSION["login"]))
{
    
    header("Location: http://localhost/FINAL/login.php");
    
    exit;
   
}

?>
