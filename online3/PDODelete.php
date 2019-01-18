<!DOCTYPE html>
<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=000207475", "000207475", "19910315");
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

$studentID = $_POST["studentID"]; 

$sql = "DELETE FROM `student_marks_bret` WHERE `Student ID` = $studentID";
$stmt = $dbh->prepare($sql);
$result = $stmt->execute();

if ($result)
    $message = "success";
else    $message = "failure";

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Server Side Data Validation</title>
        <style type="text/css">
            .error { color:red;}
            .good {color:green;}
        </style>
    </head>
    <body>
        <h1>Server Side Data Validation</h1>
        <?php
       
        echo "<p>$message</p>";
        echo "<p>$sql</p>";
 
        ?>
    </body>
</html>