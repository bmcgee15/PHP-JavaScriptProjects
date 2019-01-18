<!DOCTYPE html>
<!--
Intake Form to redirect to listBuilder.php if
validation is successfull and index.html if not.
This app creates a shopping list for user
Created by Bret McGee - 10/03/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form Validator</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <h1>Store Form Validator</h1>
        <table>
        <?php

        // Create the items session array with first item for the table
        $_SESSION["items"] = array("Item Description");

        // STORE NAME VALIDATOR - Valid: Build Table Row, Invalid: Display Error Message
        $storeName = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
        $storePattern = "/(^[A-Z][a-z]*|^\d+)(\s{1}([A-Z][a-z]*|\d+))*/";

        $matches = [];
        $result = preg_match($storePattern, $storeName, $matches);
        if (preg_match($storePattern, $storeName) && $matches[0] == $storeName){
            echo "<tr><td>Store Name</td><td>$storeName</td></tr>";
        } else {
            echo "<p>Store Name is not properly formatted</p>";
        }

        // STREET ADDRESS VALIDATOR - Valid: Build Table Row, Invalid: Display Error Message
        $streetAddress = filter_input(INPUT_GET, "address", FILTER_SANITIZE_STRING);
        $addressPattern = "/^[\d]*[\s][A-Z][a-z]+[\s](st\.|rd\.|ave\.|blvd\.)([\s](E|N|W|S))*/";

        if (preg_match($addressPattern, $streetAddress)){
            echo "<tr><td>Street Address</td><td>$streetAddress</td></tr>";
        } else {
            echo "<p>Street Address is not properly formatted</p>";
        }

        // CITY NAME VALIDATOR - Valid: Build Table Row, Invalid: Display Error Message
        $city = filter_input(INPUT_GET, "city", FILTER_SANITIZE_STRING);
        $cityPattern = "/^[A-Z][a-z]+$/";

        if (preg_match($cityPattern, $city)){
            echo "<tr><td>City</td><td>$city</td></tr>";
        } else {
            echo "<p>City is not properly formatted</p>";
        }

        // POSTAL CODE VALIDATOR - Valid: Build Table Row, Invalid: Display Error Message
        $postalCode = filter_input(INPUT_GET, "postal", FILTER_SANITIZE_STRING);
        $postalPattern = "/^([A-Z][0-9][A-Z]([\s][0-9][A-Z][0-9]|[0-9][A-Z][0-9]))$/";

        if (preg_match($postalPattern, $postalCode)){
            echo "<tr><td>Postal Code</td><td>$postalCode</td></tr>";
        } else {
            echo "<p>Postal Code is not properly formatted</p>";
        }
        
        // If all valid store variables in session variables and display get started button
        // which reroutes to listBuilder.php. If invalid display back to form button
        if ((preg_match($storePattern, $storeName) && $matches[0] == $storeName)&&(preg_match($addressPattern, $streetAddress))&&(preg_match($cityPattern, $city))&&(preg_match($postalPattern, $postalCode))){
            echo '<form action="listBuilder.php">
        <input type="submit" id="buttonCenter" name="submit" value="Get Started">
        </form>';
        $_SESSION["name"] = $storeName;
        $_SESSION["address"] = $streetAddress;
        $_SESSION["city"] = $city;
        $_SESSION["postal"] = $postalCode;
        } else {
            echo '<form action="index.html">
        <input type="submit" id="buttonCenter" name="submit" value="Back to Form">
        </form>';
        }
        
        ?>
        </table>
    </body>
</html>
