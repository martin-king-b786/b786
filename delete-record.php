<?php
    function cleanupentries($entry) {
                $entry = trim($entry);
                $entry = stripslashes($entry);
                $entry = htmlspecialchars($entry);
                return $entry;
        }
        $no_of_entries = $_POST["checked"];
        
        $details = $_POST["details"];
        
        $details = explode("&",$details);
        
        foreach($details as $entry) {
            $entry_id = str_replace("id=", "", $entry);
            
            include 'db-details.php';

            $mysqli= new mysqli("localhost","$u","$p","$db");

            $con=mysqli_connect("localhost","$u","$p","$db");

            if(!$mysqli->query("DELETE FROM email_backup WHERE ID=$entry_id;")
            ){
                echo 'Error: ('.$mysqli->errno . ") " . $mysqli->error;
            }
            if($mysqli->errno) {

            }
            
            echo $entry_id.'&';
        }

?>