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
    <h1>Results</h1>
    <p>
        Scores will display here.
    </p>
    <a href="instructorhome.html">Home</a><br>
    <a href="instructorlogin.html">Logout</a>
</body>
</html>