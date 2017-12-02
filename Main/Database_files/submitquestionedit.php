<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $id = $_POST['id'];
	$status = $_POST['status'];
	$questionStatement = $_POST['questionStatement'];
	$correctAnswerIsExactly = $_POST['correctAnswerIsExactly'];
	$numberOfPoints = $_POST['numberOfPoints'];
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$sectionNumber = $_POST['sectionNumber'];
	$phpGraderCode = $_POST['phpGraderCode'];
	edit_question(
		$id, $status, $questionStatement, 
		$correctAnswerIsExactly, $numberOfPoints, $description, 
		$keywords, $sectionNumber, $phpGraderCode
	);
}