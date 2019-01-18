<!--
  The back end logic for the tweet write app

  Bret McGee - December 6th 2018

  I, Bret McGee, 000207475 certify that this material is my original work.
  No other person's work has been used without due acknowledgement.
-->
<?php
// connects to the csunix through the connect.php file
include "connect.php";

// initialize and set the tweet variable with the post request from the main form on index.html
$tweet = filter_input(INPUT_POST, "tweet", FILTER_SANITIZE_SPECIAL_CHARS);

// create, prepare and execute an SQL statement that inserts tweets into the tbl_tweet table
$command = "INSERT INTO `tbl_tweet`(`tweet`)
VALUES (?)";
$query = $dbh->prepare($command);
$params = [$tweet];
$query->execute($params);
?>