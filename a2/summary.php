<!DOCTYPE html>
<!--
Intake Form to redirect to listBuilder.php if user wants
to add more items and index.html when user is finished.
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
        <title>List Summary</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <h1>Grocery List Summary</h1>
        <h2>For <?= $_SESSION["name"] ?></h2>
        <br><br>
        <h2>Store Information</h2>
        <table>

        <?php
        /*
        * Store session variables into local variables and
        * display the store information in a table
        */
        $storeName = $_SESSION["name"];
        $streetAddress = $_SESSION["address"];
        $city = $_SESSION["city"];
        $postalCode = $_SESSION["postal"];
        echo "<tr><td>Store Name</td><td>$storeName</td></tr>";
        echo "<tr><td>Street Address</td><td>$streetAddress</td></tr>";
        echo "<tr><td>City</td><td>$city</td></tr>";
        echo "<tr><td>Postal Code</td><td>$postalCode</td></tr>";

        ?>
        </table>
        <br><br>
        <h2>Item List</h2>
        <table>

        <?php
        // Display the items in the items session array in a table
        $count = 1;
        foreach ($_SESSION['items'] as $value){
           echo "<tr><td>Item $count</td><td>$value</td></tr>";
           $count++;
        }

        ?>


        </table>
        <br>
        <form action="listBuilder.php">
        <input type="submit" name="submit" value="Back to List Builder">
        </form>
        <form action="index.html">
        <input type="submit" name="submit" value="End Session">
        </form>
        <?php
            /* if the end session button is pressed go back to main form,
            *  empty the items session array and restart/unset the session
            */
            if(isset($_REQUEST['add']))
            {
                for ($i = 0;$i > count($_SESSION["items"]);$i++){
                    array_pop($_SESSION["items"]);
                }
                session_reset();
                sessions_unset();
            }
        
        ?>
    </body>
</html>