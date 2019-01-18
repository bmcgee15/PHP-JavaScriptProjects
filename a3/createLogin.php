<!DOCTYPE html>

<?php

/*
This is the page for creating accounts
Created by Bret McGee - 10/19/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/

// link to the file that connects to the phpMyAdmin DB
include "connect.php";

// filter/sanitize input parameters from index.html
$userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$confirm = filter_input(INPUT_POST, "confirm", FILTER_SANITIZE_STRING);

// check if the filtered input parameters returned false, or null
if ($userName === false || $userName === null || $password === false || $password === null || $confirm === false || $confirm === null){
    // if false or null display BAD PARAMETERS as a header1
    echo "<div><h1>BAD PARAMETERS</h1></div>";
} else {

// initialize userNames array
$userNames = [];

// create, prepare and execute an SQL statement that selects the entries in the Username column from the UserLogin table
$command = "SELECT `Username` FROM `UserLogin`";
$stmt = $dbh->prepare($command);
$stmt->execute();

// a loop that fetches the rows from $stmt and pushes each username to the userNames array
while ($row = $stmt->fetch()) {
    array_push($userNames, $row['Username']);
}

?>
<html>
    <head>

        <!-- Page Title, Meta Date & Link to CSS Sheet -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">

    </head>
    <body>
        <div id="container">

            <?php
            // Check if the username already exists
            if (in_array($userName, $userNames)) {
                echo "<h1>That username aleady exists</h1>";
            ?>

            <!-- Display a button to return to index.html if the username already exists -->
            <input type="button" id="buttons" value="TRY DIFFERENT USERNAME" onclick="window.location.href='index.html'" />
            <?php

            // Check if the passwords match
            } elseif ($password !== $confirm){
                echo "<h1>The passwords do not match</h1>";
                ?>

                <!-- Display a button to return to index.html if the passwords did not match -->
                <input type="button" id="buttons" value="MATCH THE PASSWORDS" onclick="window.location.href='index.html'" />
                <?php  

            // If username doesn't exist and passwords match
            } else {

                // create, prepare and execute an SQL statement that inserts the username and password into the UserLogin table
                $command = "INSERT INTO  `UserLogin` (  `Username` ,  `Password` ) 
                VALUES (
                ?,  ?
                )";
                $query = $dbh->prepare($command);
                $query->execute([$userName, $password]);
                ?>

                <!-- Display the account creation successful message -->
                <h1>Account creation successful <?=$userName?>, return home to login</h1>
                <input type="button" id="buttons" value="LOGIN" onclick="window.location.href='index.html'" />
                <?php 
            }
        }
            ?>
            <br>
        </div>
    </body>
</html>