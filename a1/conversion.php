<!DOCTYPE html>
<?php
/* A simple Fahrenheit/Celsius conversion web app
 * Created by Bret McGee - 9/19/2018
 * I, Bret McGee, 000207475 certify that this material
 * is my original work. No other person's work has
 * been used without due acknowledgement.
 */
?>
<html lang="en">
    <head>
        <title>Temperature Converter</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <table>

        <!-- checks which conversion type was picked then fills form accordingly -->
        <?php
        $tempType = $_GET["type"];
        if ($tempType == "Celsius to Fahrenheit"){

            $title1 = "Celsius";
            $title2 = "Fahrenheit";
            echo "<tr><th>$title1</th><th>$title2</th></tr>";

            for ($i = $_GET["MinVal"]; $i <= $_GET["MaxVal"]; $i += $_GET["StepVal"]){
                // Couldn't for the life of me figure out how to do the
                // conversion inside of the string between the <td></td>
                $far = sprintf('%0.2f', ($i * 1.8) + 32);
                $cel = sprintf('%0.2f', $i);
                echo ("
                <tr>
                    <td>$cel</td>
                    <td>$far</td>
                </tr>");
            }
        } else {

            $title1 = "Fahrenheit";
            $title2 = "Celsius";
            echo "<tr><th>$title1</th><th>$title2</th></tr>";
            
            for ($i = $_GET["MinVal"]; $i <= $_GET["MaxVal"]; $i += $_GET["StepVal"]){
                $cel = sprintf('%0.2f', ($i - 32) / 1.8);
                $far = sprintf('%0.2f', $i);
                echo ("
                <tr>
                    <td>$far</td>
                    <td>$cel</td>
                </tr>");
            }
        }

        ?>
        </table>
        <!-- Decided to add a button to go back to page 1 because why not -->
        <form method="GET" action="index.html">
            <input type="submit" value="Change Conversion Settings">
        </form>
    </body>
</html>
