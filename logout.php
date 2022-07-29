<?php

session_start();

if(isset($_SESSION['taruc_studentid']))
{
    
    
    $_SESSION['taruc_studentid'] = NULL;
    unset($_SESSION['taruc_studentid']);
}



header("Location: login.php");

die;

?>

