<?php
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<body>
    <h1>Edit Question</h1>
    <p>
        <select>
            <option value="Q1">Q1: Section 1.1.3: Internet and Transmission Control Protocol</option>
        </select>
    </p>
    
    <form action="edit_question.php" method="post">
        Status:<br>
        <input type="radio" name="status" value="active"> Active<br>
        <input type="radio" name="status" value="inactive"> Inactive<br>
        <input type="radio" name="status" value="draft" checked> Draft<br>
        Question statement: <input type="text" name="questionStatement"><br>
        Correct answer: <input type="text" name="correctAnswerIsExactly"><br>
        Number of points: <input type="text" name="numberOfPoints"><br>
        Description: <input type="text" name="description"><br>
        Keywords: <input type="text" name="keywords"><br>
        Section number: <input type="text" name="sectionNumber"><br>
        PHP Grader Code: <input type="text" name="phpGraderCode"><br>
        <input type="submit">
    </form>
    <a href="instructorhome.php">Home</a><br>
    <a href="login.html">Logout</a>
</body>
</html>