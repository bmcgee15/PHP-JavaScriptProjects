
<?php
/*
This is the page to edit entries
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

// filter/sanitize input parameters
$firstname = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
$comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);
$editid = filter_input(INPUT_POST, "selectid", FILTER_VALIDATE_INT);

// if editid is not falso or null, create, prepare and execute the update statement by editid
if ($editid !== False and $editid !== null) {
        $editcommand = "UPDATE `IntakeData` SET `FirstName`='$firstname',`LastName`='$lastname',`Email`='$email', `PhoneNumber`=$phone,`Comments`='$comment' WHERE EntryNumber=?";
        $stmt = $dbh->prepare($editcommand);
        $stmt->execute([$editid]);
    }

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
        <div id="editDiv"><?php

        // Test if user has access
        if ($access){

        // instantialize the username, entry number, username, intakedate, firstname, lastname, email, phonenumber and comment array variales
        $username = $_SESSION['userName'];
        $EntryNumbers = [];
        $Usernames = [];
        $IntakeDates = [];
        $FirstNames = [];
        $LastNames = [];
        $Emails = [];
        $PhoneNumbers = [];
        $Comments = [];

        // create, prepare and execute an SQL statement that selects entrynumber, username, intakedate, firstname,
        // lastname, email, phonenumber and comments where username matches username in the db
        $command = "SELECT  `EntryNumber` ,  `Username` ,  `IntakeDate` ,  `FirstName`,  `LastName` ,  `Email` , `PhoneNumber`,  `Comments`
        FROM  `IntakeData` 
        WHERE  `Username` = ?
        ORDER BY  `EntryNumber`";
        $stmt = $dbh->prepare($command);
        $stmt->execute([$username]);
                
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


?>          <!-- Display the edit heading title -->
            <h1 id="editid">Edit your entries</h1>

            <!-- This is the form that displays all of the info in a table to choose to edit -->
            <form id="editForm" action="" method="post">
            <br>
            <table>

            <!-- Displays the title of each column -->
            <tr><td>Selection</td><td>EntryNumbers</td><td>Usernames</td><td>IntakeDates</td><td>FirstNames</td><td>LastNames</td><td>Emails</td><td>PhoneNumbers</td><td>Comments</td></tr>
            <?php

            // Loops through to create the table and fill it with the date previously pulled from the db
            for ($i = 0; $i < count($EntryNumbers); $i++) {
                echo "<tr><td><input type='radio' name='selectid' value=$EntryNumbers[$i]></td><td>$EntryNumbers[$i]</td><td>$Usernames[$i]</td><td>$IntakeDates[$i]</td><td>$FirstNames[$i]</td><td>$LastNames[$i]</td><td>$Emails[$i]</td><td>$PhoneNumbers[$i]</td><td>$Comments[$i]</td></tr>";
            }
            ?>
            </table>
            <br>

            <!-- Display the form inputs used to edit the selected row -->
            First Name:<br><input id="editinput" type="text" name="firstName" minLength="1" maxLength="25" required><br>
            Last Name:<br><input id="editinput" type="text" name="lastName" minLength="1" maxLength="25" required><br>
            Email:<br><input id="editinput" type="email" name="email" maxLength="50" required><br>
            Phone Number:<br><input id="editinput" type="number" name="phone"><br><br>
            <textarea name="comment" placeholder="Comments: (Optional)"></textarea><br><br>
            <br>

            <!-- Display the edit button to edit the selected row -->
            <input type="submit" id="editbuttons" name="editButton" value="Edit Selection"/>
            <br>
            </form>
            <br>

            <!-- Display the view, delete, back and logout buttons -->
            <input type="button" id="extrabuttons" value="View Page" onclick="window.location.href='viewEntries.php'"/>
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