<?php

require_once('initialize.php');


function submit_answer()
{
    global $db;

$username = $_SESSION['username'];
$studentid = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $answer = $_POST['answer'];
    $questionid = $_GET['question_id'];
    $score = calculate_score($studentid, $answer);

    insert_student_score($studentid, $questionid, $score);
}
   
}


function calculate_score($id, $ans)
{
    // Calculate the score here
}


?>