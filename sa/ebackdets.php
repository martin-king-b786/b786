<?php

    $user = $_POST['user'];
    $pass = $_POST['pass'];


    if($user == "emailback"
    && $pass == "b786!")
    {
        include("email_backup.php");
    }
    else {
        include("eback.php");
    }
    
?>

