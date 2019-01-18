
<?php
/*
This is the page to gather entries
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
        <title>Gather Entries</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">

    </head>
    <body>
        <?php

        // Test if user has access
        if ($access){?>
        <div>

        <!-- Display the username and the gather entries heading title -->
        <h1><?=$_SESSION['userName']?></h1>
        <h1>Gather your entries</h1>

            <!-- Display the form inputs used to create entries -->
            <form action="" method="POST">
                    First Name: <input type="text" name="firstName" minLength="1" maxLength="25" required><br>
                    Last Name: <input type="text" name="lastName" minLength="1" maxLength="25" required><br>
                    Email: <input type="email" name="email" maxLength="50" required><br>
                    Phone Number: (Optional)<input type="number" name="phone"><br>
                    <textarea name="comment" placeholder="Comments: (Optional)"></textarea><br><br>
                    <input type="submit" name="submit" value="Submit">
            </form><br>
            <?php

            // Check if submit button has been set
            if(isset($_REQUEST['submit']))
            {
                // filter/sanitize input parameters
                $username = $_SESSION['userName'];
                $firstname = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_SPECIAL_CHARS);
                $lastname = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
                $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
                $comment = filter_input(INPUT_POST, "comment", FILTER_SANITIZE_SPECIAL_CHARS);

                // create, prepare and execute an SQL statement that inserts username, firstname, lastname, email, phonenumber and comments into the IntakeData table
                $command = "INSERT INTO `IntakeData`(`Username`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Comments`)
                VALUES (?,?,?,?,?,?)";
                $query = $dbh->prepare($command);
                $params = [$username,$firstname,$lastname,$email,$phone,$comment];
                $query->execute($params);
            }
            ?>

            <!-- Display the view, edit, delete, back and logout buttons -->
            <input type="button" id="buttons" value="View Entries" onclick="window.location.href='viewEntries.php'"/>
            <br>
            <input type="button" id="buttons" value="Edit Entries" onclick="window.location.href='editEntries.php'"/>
            <br>
            <input type="button" id="buttons" value="Delete Entries" onclick="window.location.href='deleteEntries.php'"/>
            <br>
            <input type="button" id="buttons" value="Back" onclick="window.location.href='loginVerification.php'"/>
            <br>
            <input type="button" id="buttons" value="LOG OUT" onclick="window.location.href='logout.php'"/>
        <?php
        } else {
            ?>

            <!-- If the user access was denied, display the session expired please log back in message with a button to go home -->
            <h1 id="editid">SESSION EXPIRED PLEASE SIGN BACK IN</h1>
            <input type="button" id="extrabuttons" value="HOME" onclick="window.location.href='index.html'"/><?php
        }
        ?>
        </div>
    </body>
</html>