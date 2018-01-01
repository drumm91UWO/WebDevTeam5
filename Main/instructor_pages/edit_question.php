<?php

include_once('../Database_files/initialize.php');

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $id = $_POST['id'];
    $status = $_POST['status'];
    $statement = $_POST['questionStatement'];
    $answer = $_POST['correctAnswerIsExactly'];
    $points = $_POST['numberOfPoints'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    $section = $_POST['sectionNumber'];
    $grader_code = $_POST['phpGraderCode'];

    edit_question($id, $status, $statement, $answer, $points, $description, $keywords, $section, $grader_code);
    echo "<script type='text/javascript'>alert('Question Edited successfully!')</script>";
    echo "<script>window.location.assign('editquestion.php');</script>";
     
}

?>