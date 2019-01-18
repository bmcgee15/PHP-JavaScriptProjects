<?php 
/*
This is the page to logout
Created by Bret McGee - 10/19/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/

// resume, unset and destroy the session
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>

        <!-- Page Title, Meta Date & Link to CSS Sheet -->
        <title>Logout</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">

    </head>
    <body>
        <div>

            <!-- Display the successfully logged out message and a button to go back home -->
            <h1>YOU SUCCESSFULLY LOGGED OUT</h1>
            <input type="button" id="buttons" value="HOME" onclick="window.location.href='index.html'"/>
        </div>
    </body>
</html>
