<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$studentid = $_POST['studentid'];
    $questionid = $_POST['questionid'];
	$score = $_POST['score'];
	$answer = $_POST['answer'];
    echo json_encode(make_score($studentid, $questionid, $score, $answer));
}
?>