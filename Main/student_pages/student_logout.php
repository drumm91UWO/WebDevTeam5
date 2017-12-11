<?php
session_start();
require_once('../Database_files/initialize.php');

if (isset($_SESSION["id"]))
{
$id = $_SESSION['id'];
update_last_student_logout($id);
session_destroy();
header("Location: login.html");
}
else
{
echo 'Session variable not set.';
}

?>