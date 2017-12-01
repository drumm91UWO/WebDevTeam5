<?php
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "student")
{
    header("Location: login.html");
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
        Results will show here.
    </p>
    <a href="studenthome.html">Home</a><br>
    <a href="login.html">Logout</a>
</body>
</html>