<!DOCTYPE html>
<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=000207475", "000207475", "19910315");
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$studentID = $_POST["studentID"];
$onlineAssignmentGrade = $_POST["onlineAssignmentGrade"];
$assignment1Grade = $_POST["assignment1Grade"];
$assignment2Grade = $_POST["assignment2Grade"];
$assignment3Grade = $_POST["assignment3Grade"];
$PHPExamGrade = $_POST["PHPExamGrade"];
$startDate = $_POST["startDate"];
$completionDate = $_POST["completionDate"];
$studentReflection = $_POST["studentReflection"]; 

$sql = "INSERT INTO student_marks_bret (`First Name`, `Last Name`, `Student ID`, `Online Assignment Grade`, `Assignment 1 Grade`, `Assignment 2 Grade`, `Assignment 3 Grade`, `PHP Exam Grade`, `Start Date`, `Completion Date`, `Student Reflection`) VALUES ('$firstName', '$lastName', '$studentID', '$onlineAssignmentGrade', '$assignment1Grade', '$assignment2Grade', '$assignment3Grade', '$PHPExamGrade', '$startDate', '$completionDate', '$studentReflection')";
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