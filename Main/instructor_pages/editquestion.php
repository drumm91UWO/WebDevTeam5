<?php

session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title>Edit Question Page</title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../Database_files/submitquestionedit.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
    integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
    integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <link href="../styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Edit Question</h1>


    <!-- NavBar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="studenthome.php"><img src="../../images/UWOWebClicker.png" alt="UWO WebClicker"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="instructorhome.php">Home </a>
            <a class="nav-item nav-link" href="activatequestion.php">Activate Question (with insights)</a>
            <a class="nav-item nav-link" href="displayscores.html">Display Scores</a>
            <a class="nav-item nav-link" href="insertnewquestion.html">Insert New Question</a>
            <a class="nav-item nav-link" href="#">Edit Question<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="deletequestion.html">Delete Question</a>
            <a class="nav-item nav-link" href="instructor_logout.php">Logout</a>
         </div>
    </div>
    </nav>


    <form action="edit_question.php" method="post">
        <p>
            <select id="selector" name="id">
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
        <input type="submit" id="button" value="Submit"><br>
    </form>
</body>
</html>