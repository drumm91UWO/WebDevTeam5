<?php 

session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}

error_reporting ( E_ALL | E_STRICT ); 
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="activatequestion.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
    integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
    integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <link href="../styles.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <h1>Activate Question</h1>
<<<<<<< HEAD
    <h3>With Insights</h3>

<!-- NavBar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="studenthome.php"><img src="../../images/UWOWebClicker.png"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="instructorhome.php">Home </a>
            <a class="nav-item nav-link" href="activatequestion.php">Activate Question (with insights)<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="displayscores.html">Display Scores</a>
            <a class="nav-item nav-link" href="insertnewquestion.html">Insert New Question</a>
            <a class="nav-item nav-link" href="editquestion.php">Edit Question</a>
            <a class="nav-item nav-link" href="deletequestion.html">Delete Question</a>
            <a class="nav-item nav-link" href="student_logout.php">Logout</a>
         </div>
    </div>
    </nav>


=======
>>>>>>> 62a2b851be6624d7cdfa4486c93ad48ea30b8397
    <p>
        <select id="selector">
            <?php
		        require_once('../Database_files/initialize.php');
		        $questions = retrieve_all_inactive_questions();
                $numberOfQuestions = count($questions);
                for($x = 0; $x < $numberOfQuestions; $x++){
                    ?><option value=<?php echo $questions[$x]['id']; ?>><?php echo $questions[$x]['description']; ?></option><?php
                }
            ?>
        </select>
    </p>
    <p>
        <button id="button" onclick="activateQuestion(document.getElementById('selector').value)">Activate Question</button> This will deactivate all questions before activating the selected question.<br>
        <button id="button2" onclick="deactivateQuestion()" disabled="true">Deactivate Question</button><br>
		<button id="button3" onclick="displayAnswersAgain()" disabled="true">Update Graph</button>
    </p>
    <div id="timer">
        The timer will be displayed here.
    </div>
    <div id="display">
        Data will be displayed here.
	   
	    <div id="barchart">
	    </div>
	  
        <!--Display bar graph here-->
    </div>
</body>
</html>
