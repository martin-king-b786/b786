<head>
    <link rel="stylesheet" href="css/layout.css"/>
</head>
<table id="email-details">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Telephone</th>
        <th>Contact Time</th>
        <th>Requirements</th>
    </thead>
    <?php
        include 'db-details.php';

        $mysqli= new mysqli("localhost","$u","$p","$db");

        $getrec = $mysqli->query("SELECT * FROM email_backup LIMIT 10");

        while($record = mysqli_fetch_array( $getrec )) {   
            ?>
        <tr>
            <td><?php echo $record['Name']; ?></td>
            <td><?php echo $record['Email']; ?></td>
            <td><?php echo $record['Telephone']; ?></td>
            <td><?php echo $record['Contact_Time']; ?></td>
            <td><?php echo $record['Requirements']; ?></td>
        </tr>
    <?php
        }
    ?>
</table>