<!DOCTYPE html>
<?php
/*
SELECT EXAM MARKS
Created by Bret McGee - 9/21/2018
I, Bret McGee, 000207475 certify that this material
is my original work. No other person's work has
been used without due acknowledgement.
*/
include "connect.php";

$minval = $_POST["minVal"];
$maxval = $_POST["maxVal"];
$studentids = [];
$firstnames = [];
$lastnames = [];
$examgrades = [];

$command = "SELECT  `First Name` ,  `Last Name` ,  `Student ID` ,  `PHP Exam Grade` 
FROM  `student_marks_bret` 
WHERE  `PHP Exam Grade` 
BETWEEN $minval 
AND $maxval 
GROUP BY  `Last Name` ASC 
ORDER BY  `PHP Exam Grade` DESC";
$stmt = $dbh->prepare($command);
$stmt->execute();
        
while ($row = $stmt->fetch()) {
    array_push($studentids, $row['Student ID']);
    array_push($firstnames, $row['First Name']);
    array_push($lastnames, $row['Last Name']);
    array_push($examgrades, $row['PHP Exam Grade']);
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Poll page</title>
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div id="container">
            <h1>Exam Grade Query</h1>
            <table>
            <?php
            for ($i = 0; $i < count($studentids); $i++) {
                echo "<tr><td>$studentids[$i]</td><td>$studentids[$i]</td><td>$firstnames[$i]</td><td>$lastnames[$i]</td><td>$examgrades[$i]</td></tr>";
            }
            ?>
            </table>
            <br>
            <i style='color:blue'><?= $command ?></i><br/>
            <p><a href="index.html">back</a></p>
        </div>
    </body>
</html>