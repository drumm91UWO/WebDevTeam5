<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$studentid = $_POST['studentid'];
    $questionid = $_POST['questionid'];
    echo json_encode(retrieve_score($studentid, $questionid));
}
?>