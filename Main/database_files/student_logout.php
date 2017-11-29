<?php
session_start();
require_once('initialize.php');

if (isset($_SESSION["id"]))
{
$id = $_SESSION['id'];
echo $id;
update_last_student_logout($id);
header("Location: ../login.html");
}
else
{
echo 'Session variable not set.';
}

?>