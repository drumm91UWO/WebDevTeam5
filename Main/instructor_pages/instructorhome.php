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
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<body>
    <h1>Instructor Home</h1>
    <p>
        <form action="deactivate_questions.php">
            <input type="submit" value="Deactivate all questions">
        </form>
    </p>
    <a href="activatequestion.php">Activate question (with insights)</a><br>
    <a href="displayscores.html">Display scores for a certain day</a><br>
    <a href="insertnewquestion.html">Insert new question</a><br>
    <a href="editquestion.html">Edit question</a><br>
    <a href="deletequestion.html">Delete question</a><br>
    <a href="instructor_logout.php">Logout</a>
</body>
</html>