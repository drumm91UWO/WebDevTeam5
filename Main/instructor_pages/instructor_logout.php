<?php
	session_start();
	require_once('../Database_files/initialize.php');
	if (isset($_SESSION["id"]))
	{
		$id = $_SESSION['id'];
		update_last_instructor_logout($id);
		session_destroy();
		header("Location: instructorlogin.html");
	}
	else
	{
		echo 'Session variable not set.';
	}
?>