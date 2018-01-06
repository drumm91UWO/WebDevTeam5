<?php
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}
include_once('../Database_files/initialize.php');
deactivate_all_activated_questions();
header("Location: instructorhome.php");
?>