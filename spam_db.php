<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/layout.css"/>
    <script type='text/javascript' src='js/contact.js'></script>
</head>

<div id="search">
    <input name="date" type="date"/>
    <button>Search</button>
    <div class="close"></div>
</div>

<form action="delete-record.php" name="details-form" id="details-form" method="post" onsubmit="return deleteRecords()">
    <table id="email-details">
        <thead>
        <th class="detail-id">Id</th>
            <th>Timestamp</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Contact Time</th>
            <th>Requirements</th>
            <th>IP</th>
            <th><button>Delete</button></th>
        </thead>
        <?php
            include 'db-details.php';

            $mysqli= new mysqli("localhost","$u","$p","$db");

            $getrec = $mysqli->query("SELECT * FROM email_backup_2 ORDER BY Timestamp DESC LIMIT 1000 ");

            while($record = mysqli_fetch_array( $getrec )) {   
                ?>
            <tr id="id-<?php echo $record['ID']; ?>">
                <td class="detail-id" id="<?php echo $record['ID']; ?>"><?php echo $record['ID']; ?></td>
                <td><?php echo $record['Timestamp']; ?></td>
                <td><?php echo $record['Name']; ?></td>
                <td><?php echo $record['Email']; ?></td>
                <td><?php echo $record['Telephone']; ?></td>
                <td><?php echo $record['Contact_Time']; ?></td>
                <td><?php echo $record['Requirements']; ?></td>
                <td><?php echo $record['IP']; ?></td>
                <td><input name="id" value="<?php echo strtolower($record['ID']); ?>" type="checkbox"/></td>
            </tr>
        <?php
            }
        ?>
    </table>
</form>

