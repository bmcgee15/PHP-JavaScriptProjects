
<?php
/*
This is the page to view entries
Created by Bret McGee - 10/19/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/

// link to the file that connects to the phpMyAdmin DB
include "connect.php";

// resume the session
session_start();

//  checking if the user is logged in to gain access to the page
$access = isset($_SESSION["userName"]);

?>
<!DOCTYPE html>
<html>
    <head>

        <!-- Page Title, Meta Date & Link to CSS Sheet -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">

    </head>
    <body>
        <div id="viewDiv"><?php

        // Test if user has access
        if ($access){


            $username = $_SESSION['userName'];
            $EntryNumbers = [];
            $Usernames = [];
            $IntakeDates = [];
            $FirstNames = [];
            $LastNames = [];
            $Emails = [];
            $PhoneNumbers = [];
            $Comments = [];
            
            // Check if post sortid is set
            if (!isset($_POST["sortid"])) {

                    // create, prepare and execute an SQL statement that selects entrynumber, username, intakedate, firstname,
                    // lastname, email, phonenumber and comments form IntakeDate table where the username matches this one
                    $command = "SELECT  `EntryNumber` ,  `Username` ,  `IntakeDate` ,  `FirstName`,  `LastName` ,  `Email` , `PhoneNumber`,  `Comments`
                    FROM  `IntakeData` 
                    WHERE  `Username` = '$username'
                    ORDER BY  `EntryNumber`";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                } else {

                    // filter input for sortid and store is into a variable
                    $sortid = filter_input(INPUT_POST, "sortid", FILTER_SANITIZE_STRING);

                    // create, prepare and execute an SQL statement that selects entrynumber, username, intakedate, firstname, lastname,
                    // email, phonenumber and comments form IntakeDate table where the username matches this one ordered by the sortid
                    $sortcommand = "SELECT  `EntryNumber` ,  `Username` ,  `IntakeDate` ,  `FirstName`,  `LastName` ,  `Email` , `PhoneNumber`,  `Comments`
                    FROM  `IntakeData` 
                    WHERE  `Username` = '$username'
                    ORDER BY  $sortid";
                    $stmt = $dbh->prepare($sortcommand);
                    $stmt->execute();
                }
                    
            // push all of the rows into the appropriate variable arrays
            while ($row = $stmt->fetch()) {
                array_push($EntryNumbers, $row['EntryNumber']);
                array_push($Usernames, $row['Username']);
                array_push($IntakeDates, $row['IntakeDate']);
                array_push($FirstNames, $row['FirstName']);
                array_push($LastNames, $row['LastName']);
                array_push($Emails, $row['Email']);
                array_push($PhoneNumbers, $row['PhoneNumber']);
                array_push($Comments, $row['Comments']);
            }


?>
            <!-- Display the view heading title -->
            <h1 id="editid">View your entries</h1>

            <!-- This is the form that displays all of the info in a table to choose to edit -->
            <form id="viewForm" action="" method="post">
            <br>
            <table>

            <!-- Displays the title of each column -->
            <tr><td>EntryNumbers</td><td>Usernames</td><td>IntakeDates</td><td>FirstNames</td><td>LastNames</td><td>Emails</td><td>PhoneNumbers</td><td>Comments</td></tr>
            <?php

            // Loops through to create the table and fill it with the date previously pulled from the db
            for ($i = 0; $i < count($EntryNumbers); $i++) {
                echo "<tr><td>$EntryNumbers[$i]</td><td>$Usernames[$i]</td><td>$IntakeDates[$i]</td><td>$FirstNames[$i]</td><td>$LastNames[$i]</td><td>$Emails[$i]</td><td>$PhoneNumbers[$i]</td><td>$Comments[$i]</td></tr>";
            }
            ?>

            <!-- Display the radio buttons used to pick the column to sort by -->
            <tr><td><input id="viewRadio" type='radio' name='sortid' value='EntryNumber'></td><td><input id="viewRadio" type='radio' name='sortid' value='UserName'></td><td><input id="viewRadio" type='radio' name='sortid' value='IntakeDate'></td><td><input id="viewRadio" type='radio' name='sortid' value='FirstName'></td><td><input id="viewRadio" type='radio' name='sortid' value='LastName'></td><td><input id="viewRadio" type='radio' name='sortid' value='Email'></td><td><input id="viewRadio" type='radio' name='sortid' value='PhoneNumber'></td><td><input id="viewRadio" type='radio' name='sortid' value='Comments'></td><tr>
            </table>
            <br>

            <!-- Display the sort button to sort the selected row -->
            <input type="submit" id="viewbuttons" name="sortButton" value="Sort By Selection"/>
            <br>
            </form>
            <br>

            <!-- Display the edit, delete, back and logout buttons -->
            <input type="button" id="extrabuttons" value="Edit Page" onclick="window.location.href='editEntries.php'"/>
            <br>
            <input type="button" id="extrabuttons" value="Delete Page" onclick="window.location.href='deleteEntries.php'"/>
            <br>
            <input type="button" id="extrabuttons" value="Back" onclick="window.location.href='loginVerification.php'"/>
            <br>
            <input type="button" id="extrabuttons" value="Log Out" onclick="window.location.href='logout.php'"/>
            <?php
            } else {
            ?>

            <!-- If the user access was denied, display the session expired please log back in message with a button to go home -->
            <h1 id="editid">SESSION EXPIRED PLEASE SIGN BACK IN</h1>
            <input type="button" id="extrabuttons" value="HOME" onclick="window.location.href='index.html'"/><?php
        }?>
        </div>
    </body>
</html>