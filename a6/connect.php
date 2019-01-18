<?php
/**
 *  The back end logic for connecting the files to the database
 *  
 *  Bret McGee - December 6th 2018
 * 
 * I, Bret McGee, 000207475 certify that this material is my original work.
 * No other person's work has been used without due acknowledgement.
 */
try {
    // create new php data object with the correct credentials
    $dbh = new PDO('mysql:host=localhost;dbname=000207475', "000207475", "19910315");
} catch (Exception $e) {
    die('Could not connect to DB: ' . $e->getMessage());
}