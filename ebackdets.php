<?php

    $user = $_POST['user'];
    $pass = $_POST['pass'];


    if($user == "emailback"
    && $pass == "b786!")
    {
        include("email_backup.php");
    }
    else if($user == "spam" && $pass == "b786!") {
        include("spam_db.php");
    }
    else {
        include("eback.php");
    }
    
?>

