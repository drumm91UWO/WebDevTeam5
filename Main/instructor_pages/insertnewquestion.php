<?php error_reporting ( E_ALL | E_STRICT ); 
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "instructor")
{
    header("Location: instructorlogin.html");
    exit();
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Insert New Question Page</title>
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
		<h1>Insert New Question</h1>
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
				<a class="nav-item nav-link" href="displayscores.php">Display Scores</a>
				<a class="nav-item nav-link active" href="#">Insert New Question<span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="editquestion.php">Edit Question</a>
				<a class="nav-item nav-link" href="deletequestion.php">Delete Question</a>
				<a class="nav-item nav-link" href="instructor_logout.php">Logout</a>
			 </div>
		</div>
		</nav>
		<?php
			require_once('../Database_files/initialize.php');
			//test if post
			if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST'){
				//post
				//gather input
				$status = $_POST["status"];
				$questionStatement = $_POST["questionStatement"];
				$correctAnswerIsExactly = $_POST["correctAnswerIsExactly"];
				$numberOfPoints = $_POST["numberOfPoints"];
				$description = $_POST["description"];
				$keywords = $_POST["keywords"];
				$sectionNumber = $_POST["sectionNumber"];
				$phpGraderCode = $_POST["phpGraderCode"];

				//validate input
				if($questionStatement && $correctAnswerIsExactly && $numberOfPoints && $description && 
					$keywords && $sectionNumber && $phpGraderCode){
					?><p>Question submitted successfully!</p><?php
					insert_question(null, $status, $questionStatement, $correctAnswerIsExactly, $numberOfPoints, 
					$description, $keywords, $sectionNumber, null, null, null, null, $phpGraderCode, null);
				}else{
					?><p>A necessary field was not filled out. Please try again.</a>.</p><?php
				}
			}
		?>
		<form action="insertnewquestion.php" method="post">
			Status:<br>
			<input type="radio" name="status" value="inactive"> Inactive<br>
			<input type="radio" name="status" value="draft" checked> Draft<br>
			Question statement: <input type="text" name="questionStatement" autofocus required><br>
			Correct answer: <input type="text" name="correctAnswerIsExactly" required><br>
			Number of points: <input type="number" name="numberOfPoints" min="1" max="100" required><br>
			Description: <input type="text" name="description" required><br>
			Keywords: <input type="text" name="keywords" required><br>
			Section number: <input type="text" name="sectionNumber" required><br>
			PHP Grader Code: <input type="text" name="phpGraderCode" required><br>
			<input type="submit">
		</form>
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
	</body>
</html>