<?php
/*
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}
*/
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
	<script type="text/javascript" src="../Database_files/submitquestionedit.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <h1>Edit Question</h1>
    <p>
        <select id="selector">
            <?php
		        require_once('../Database_files/initialize.php');
		        $questions = retrieve_all_questions();
                $numberOfQuestions = count($questions);
                for($x = 0; $x < $numberOfQuestions; $x++){
                    ?><option value=<?php echo $questions[$x]['id']; ?>><?php echo $questions[$x]['description']; ?></option><?php
                }
            ?>
        </select>
    </p>
    Status:<br>
    <input type="radio" name="status" value="inactive"> Inactive<br>
    <input type="radio" name="status" value="draft" checked> Draft<br>
    Question statement: <input type="text" name="questionStatement"><br>
    Correct answer: <input type="text" name="correctAnswerIsExactly"><br>
    Number of points: <input type="text" name="numberOfPoints"><br>
    Description: <input type="text" name="description"><br>
    Keywords: <input type="text" name="keywords"><br>
    Section number: <input type="text" name="sectionNumber"><br>
    PHP Grader Code: <input type="text" name="phpGraderCode"><br>
	<button id="button" onClick="submit()">Submit</button><br>
    <a href="instructorhome.php">Home</a><br>
    <a href="login.html">Logout</a>
</body>
</html>