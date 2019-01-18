<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=000207475', "000207475", "19910315");
} catch (Exception $e) {
    die('Could not connect to DB: ' . $e->getMessage());
}


