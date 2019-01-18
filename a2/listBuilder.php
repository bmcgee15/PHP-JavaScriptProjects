<!DOCTYPE html>
<!--
Intake Form to redirect to itself if item is added
and summary.php when the to summary button is clicked.
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
        <h1>My Shopping List</h1>
        <h2>For <?= $_SESSION["name"] ?></h2>
        <br><br>
        <h2>Please enter the item you would like to add</h2>
        <p>If you are returning from the summary page, the list will repopulate once you add a new item</p>

        <form action="" method="GET">
        <input type="text" name="item" id="item" require>
        <input type="submit" name="add" value="Add Item">
        </form>
        <table>
        <tr><td>Item Number</td><td><?= $_SESSION["items"][0]?></td><tr>
        <?php

            // Add item button logic
            if(isset($_REQUEST['add']))
            {
                /* If add button is clicked with no item in the texbox
                *  Display error message, and rebuild the current list
                */
                if($_GET["item"] == "" || $_GET["item"] == null){
                    echo "<p>Please Enter an Item</p>";
                    $count = 1;
                    foreach ($_SESSION['items'] as $k => $value){
                        if ($k < 1) continue;
                        echo "<tr><td>Item $count</td><td>$value</td></tr>";
                        $count++;
                    }
                  /* If add button is clicked and item already exists,
                  *  Display error message, and rebuild the current list
                  */
                } else if (in_array($_GET["item"], $_SESSION["items"])){
                    echo "<p>Item already exists</p>";
                    $count = 1;
                    foreach ($_SESSION['items'] as $k => $value){
                        if ($k < 1) continue;
                        echo "<tr><td>Item $count</td><td>$value</td></tr>";
                        $count++;
                    }
                } else
                {
                    /* If add button is clicked and item doesnt exists,
                    *  Add item to items array and rebuild the new list
                    */
                    array_push($_SESSION['items'], $_GET["item"]);
                    $count = 1;
                    foreach ($_SESSION['items'] as $k => $value){
                        if ($k < 1) continue;
                        echo "<tr><td>Item $count</td><td>$value</td></tr>";
                        $count++;
                    }
                }
            }
        ?>
        <?php
        
        
        ?>
        
        </table>
        <form action="summary.php">
        <input type="submit" name="submit" value="To Summary">
        </form>
        <table>
    </body>
</html>