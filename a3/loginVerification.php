
<?php

/*
This is the login verification page
Created by Bret McGee - 10/19/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/

// link to the file that connects to the phpMyAdmin DB
include "connect.php";

// starting the session
session_start();

// check if session username variable has been set
if(isset($_SESSION['userName'])){
    // if set, put contents into $userName variable
    $userName = $_SESSION['userName'];
} else {
    // if not set, filter the POST input and put contexts into $userName variable 
    $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING);
}

// check if session password variable has been set
if(isset($_SESSION['password'])){
    // if set, put contents into $userName variable
    $password = $_SESSION['password'];
} else {
    // if not set, filter the POST input and put contexts into $password variable
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
}

// create, prepare and execute an SQL statement that selects username and password where equal the current sessions username and password
$command = "SELECT `Username`, `Password` FROM `UserLogin` WHERE `Username` = ? AND `Password` = ?";
$query = $dbh->prepare($command);
$query->execute([$userName, $password]);

        // loop the query fetch command to put the username and password into variables
        for($i=0; $row = $query->fetch(); $i++){
            $dbUserName = $row['Username'];
            $dbPassword = $row['Password'];
        }


?>
<!DOCTYPE html>
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
            // check if the username and password variables have been set
            if(isset($dbPassword) && isset($dbUserName)){
                // check if the username and password match those in the database
                if ($userName == $dbUserName && $password == $dbPassword){

                    // Display the username and that the account has been verified
                    ?><h1><?= $userName?></h1>
                    <h2>Account Verified</h2>

                    <!-- Add the buttons to link to all of the functions to gather, view edit and delete entries -->
                    <input type="button" id="buttons" value="Gather New Entries" onclick="window.location.href='gatherEntries.php'"/>
                    <input type="button" id="buttons" value="View Entries" onclick="window.location.href='viewEntries.php'"/>
                    <input type="button" id="buttons" value="Edit Entries" onclick="window.location.href='editEntries.php'"/>
                    <input type="button" id="buttons" value="Delete Entries" onclick="window.location.href='deleteEntries.php'"/>
                    <br>
                    <!-- Display the logout button -->
                    <input type="button" id="buttons" value="LOG OUT" onclick="window.location.href='logout.php'"/>
                    <?php

                    // add the username and password to the session variables
                    $_SESSION['userName'] = $userName;
                    $_SESSION['password'] = $password;
                  }
                } else {
                    ?>
                    <!-- Display invalid login message and buttons to go back if login failed -->
                    <h1>Invalid Login Credentials</h1>
                    <input type="button" id="buttons" value="Back to login page" onclick="window.location.href='index.html'"/>
                    <?php
                }

            ?>

        </div>
    </body>
</html>