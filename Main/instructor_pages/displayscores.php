<?php
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}
require_once('../Database_files/initialize.php');
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title>Display Scores For Date Page</title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" 
    integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" 
    integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
    integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
    integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
    integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link href="../styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Results</h1>

<!-- NavBar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="instructorhome.php"><img src="../../images/UWOWebClicker.png" alt="UWO WebClicker"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="instructorhome.php">Home </a>
            <a class="nav-item nav-link" href="activatequestion.php">Activate Question (with insights)</a>
            <a class="nav-item nav-link active" href="displayscores.php">Display Scores<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="insertnewquestion.php">Insert New Question</a>
            <a class="nav-item nav-link" href="editquestion.php">Edit Question</a>
            <a class="nav-item nav-link" href="deletequestion.php">Delete Question</a>
            <a class="nav-item nav-link" href="instructor_logout.php">Logout</a>
         </div>
    </div>
    </nav>
	<?php
	if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST'){
		//POST
		$dateActivatedOn = $_POST['dateActivatedOn'];
		//get all questions activated on that day
		$query = "SELECT * FROM questions WHERE time_of_activation >= '" . $dateActivatedOn . 
		" 00:00:00' AND time_of_activation <= '" . $dateActivatedOn . " 23:59:59'";
		//echo $query;
		$questions = retrieve_by_query($query);
		//display the results
		echo "<table class='blueTable'>
			<tr>
			<th></th>";
		foreach($questions as $question){
			echo "<th>" . $question['description'] . "</th>";
		}
		$scores = array();
		foreach($questions as $question){
			//get scores for this Question
			$temp = retrieve_score_with_question($question['id']);
			foreach($temp as $score){
				array_push($scores, $score);
			}
		}
		//organize data
		$tempScores = array();
		$totalScores = array();
		for($i = 0; $i < sizeof($scores); $i++){
			$scoreHasAlreadyBeenAdded = false;
			for($k = 0; $k < sizeof($totalScores); $k++){
				if($totalScores[$k][0]['student_id'] == $scores[$i]['student_id']){
					$scoreHasAlreadyBeenAdded = true;
				}
			}
			if(!$scoreHasAlreadyBeenAdded){
				array_push($tempScores, $scores[$i]);
				for($j = ($i + 1); $j < sizeof($scores); $j++){
					if($scores[$i]['student_id'] == $scores[$j]['student_id']){
						array_push($tempScores, $scores[$j]);
					}
				}
				array_push($totalScores, $tempScores);
				$tempScores = array();
			}
		}
		//display student data
		foreach($totalScores as $student){
			echo "<tr>";
			$name = get_student_name($student[0]['student_id']);
				if($name){
					echo "<td>" . $name['first_name'] . " " . $name['last_name'] . ", ID: " . $student[0]['student_id'] . "</td>";
				}else{
					echo "<td>" . "Unregistered student" . ", ID: " . $student[0]['student_id'] . "</td>";
				}
				foreach($questions as $question){
					$scoreFound = false;
					foreach($student as $score){
							if($score['question_id'] == $question['id']){
								$scoreFound = true;
								//echo it out
								echo "<td>" . $score['score'] . "</td>";
							}
					}
					if(!$scoreFound){
						//echo out an mepty table data element
						echo "<td>" . "</td>";
					}
				}
			echo "</tr>";
		}
		echo "</table>";
	}
	?>
	<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        Date activated on: <input type="date" name="dateActivatedOn" required><br>
        <input type="submit">
    </form>
</body>
<footer>
    <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px"
                src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                alt="Valid CSS!" />
            </a>
            <img src="//www.w3.org/Icons/WWW/w3c_home_nb" alt="W3C" width="72" height="47" />
        </p>
</footer>
</html>