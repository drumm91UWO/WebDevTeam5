<?php
session_start();
require_once('../database_files/initialize.php');

if (isset($_SESSION["id"]))
{
$id = $_SESSION['id'];
update_last_student_logout($id);
header("Location: login.html");
}
else
{
echo 'Session variable not set.';
}

?>