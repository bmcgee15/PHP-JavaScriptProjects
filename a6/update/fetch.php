<?php
/**
 *  The back end logic for the tweet write app
 *  
 *  Bret McGee - December 6th 2018
 * 
 * I, Bret McGee, 000207475 certify that this material is my original work.
 * No other person's work has been used without due acknowledgement.
 */

// connects to the csunix through the connect.php file
include "connect.php";

// create, prepare and execute an SQL statement that selects the tweets from the tbl_tweet table and orders them by decending id
$command = "SELECT `tweet` FROM `tbl_tweet` ORDER BY `tweet_id` DESC";
$query = $dbh->prepare($command);
$result = $query->execute();
$json_array = array();
while ($row = $query->fetch()) {
    $json_array[] = $row;
}

// set the header and echo out the encoded json data
header('Content-type: application/json');
echo json_encode($json_array);
?>