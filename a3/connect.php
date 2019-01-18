<?php
/*
This is the page to connect to the database
Created by Bret McGee - 10/19/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/

// Try to connect to the database, if not display error message
try {
    $dbh = new PDO('mysql:host=localhost;dbname=000207475', "000207475", "19910315");
} catch (Exception $e) {
    die('Could not connect to DB: ' . $e->getMessage());
}