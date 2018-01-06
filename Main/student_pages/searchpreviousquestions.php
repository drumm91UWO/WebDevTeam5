<?php
session_start();
require_once('../Database_files/initialize.php');
date_default_timezone_set('UTC');
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "student")
{
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <title>Search Questions Results Page</title>
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
	<!-- Nav/bar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="studenthome.php"><img src="../../images/UWOWebClicker.png" alt="UWO WebClicker"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="studenthome.php">Home</a>
            <a class="nav-item nav-link active" href="searchpreviousquestions.php">Search Previous Questions <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="student_logout.php">Logout</a>
         </div>
    </div>
    </nav>
	<?php
		if (!empty($_POST)){
			//a search has been submitted
			if ($_SERVER['REQUEST_METHOD'] === 'POST')
			{
				$id = $_POST['idIsExactly'];
				$correctAnswerIsExactly = $_POST['correctAnswerIsExactly'];
				$correctAnswerContains = $_POST['correctAnswerContains'];
				$numberOfPointsGreaterThan = $_POST['numberOfPointsGreaterThan'];
				$numberOfPointsEqualTo = $_POST['numberOfPointsEqualTo'];
				$numberOfPointsLessThan = $_POST['numberOfPointsLessThan'];
				$descriptionContains = $_POST['descriptionContains'];
				$containsKeyword = $_POST['keywords'];
				$sectionNumber = $_POST['sectionNumber'];
				$averagePointsEarnedByClassGreaterThan = $_POST['averagePointsEarnedByClassGreaterThan'];
				$averagePointsEarnedByClassLessThan = $_POST['averagePointsEarnedByClassLessThan'];
				$activatedOnOrAfter = $_POST['activatedOnOrAfter'];
				$activatedBefore = $_POST['activatedBefore'];
				$deactivatedOnOrAfter = $_POST['deactivatedOnOrAfter'];
				$deactivatedBefore = $_POST['deactivatedBefore'];
				$condition1 = $_POST['condition1'];
				$condition2 = $_POST['condition2'];
				$condition3 = $_POST['condition3'];
				$condition4 = $_POST['condition4'];
				$condition5 = $_POST['condition5'];
				$condition6 = $_POST['condition6'];
				$condition7 = $_POST['condition7'];
				$condition8 = $_POST['condition8'];
				$condition9 = $_POST['condition9'];
				$condition10 = $_POST['condition10'];
				$condition12 = $_POST['condition12'];
				$condition13 = $_POST['condition13'];
				$condition15 = $_POST['condition15'];
				$condition16 = $_POST['condition16'];
				$aFieldHasBeenUsed = false;
				$query = "SELECT * FROM questions WHERE time_of_deactivation IS NOT NULL AND (";
				if($id){
					$query = $query . "id = " . $id . " ";
					$aFieldHasBeenUsed = true;
				}
				if($correctAnswerIsExactly && $aFieldHasBeenUsed){
					$query = $query . $condition1 . " " . "correct_answer = '" . $correctAnswerIsExactly . "' ";
				}else if($correctAnswerIsExactly){
					$query = $query . "correct_answer = '" . $correctAnswerIsExactly . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($correctAnswerContains && $aFieldHasBeenUsed){
					$query = $query . $condition2 . " " . "correct_answer LIKE '%" . $correctAnswerContains . "%' ";
				}else if($correctAnswerContains){
					$query = $query . "correct_answer LIKE '%" . $correctAnswerContains . "%' ";
					$aFieldHasBeenUsed = true;
				}
				if($numberOfPointsGreaterThan && $aFieldHasBeenUsed){
					$query = $query . $condition3 . " " . "points > " . $numberOfPointsGreaterThan . " ";
				}else if($numberOfPointsGreaterThan){
					$query = $query . "points > " . $numberOfPointsGreaterThan . " ";
					$aFieldHasBeenUsed = true;
				}
				if($numberOfPointsEqualTo && $aFieldHasBeenUsed){
					$query = $query . $condition4 . " " . "points = " . $numberOfPointsEqualTo . " ";
				}else if($numberOfPointsEqualTo){
					$query = $query . "points = " . $numberOfPointsEqualTo . " ";
					$aFieldHasBeenUsed = true;
				}
				if($numberOfPointsLessThan && $aFieldHasBeenUsed){
					$query = $query . $condition5 . " " . "points < " . $numberOfPointsLessThan . " ";
				}else if($numberOfPointsLessThan){
					$query = $query . "points < " . $numberOfPointsLessThan . " ";
					$aFieldHasBeenUsed = true;
				}
				if($descriptionContains && $aFieldHasBeenUsed){
					$query = $query . $condition6 . " " . "description LIKE '%" . $descriptionContains . "%' ";
				}else if($descriptionContains){
					$query = $query . "description LIKE '%" . $descriptionContains . "%' ";
					$aFieldHasBeenUsed = true;
				}
				if($containsKeyword && $aFieldHasBeenUsed){
					$query = $query . $condition7 . " " . "keywords LIKE '%" . $containsKeyword . "%' ";
				}else if($containsKeyword){
					$query = $query . "keyword LIKE '%" . $containsKeyword . "%' ";
					$aFieldHasBeenUsed = true;
				}
				if($sectionNumber && $aFieldHasBeenUsed){
					$query = $query . $condition8 . " " . "section_number = '" . $sectionNumber . "' ";
				}else if($sectionNumber){
					$query = $query . "section_number = '" . $sectionNumber . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($averagePointsEarnedByClassGreaterThan && $aFieldHasBeenUsed){
					$query = $query . $condition9 . " " . "average_points_earned > " . $averagePointsEarnedByClassGreaterThan . " ";
				}else if($averagePointsEarnedByClassGreaterThan){
					$query = $query . "average_points_earned > " . $averagePointsEarnedByClassGreaterThan . " ";
					$aFieldHasBeenUsed = true;
				}
				if($averagePointsEarnedByClassLessThan && $aFieldHasBeenUsed){
					$query = $query . $condition10 . " " . "average_points_earned < " . $averagePointsEarnedByClassLessThan . " ";
				}else if($averagePointsEarnedByClassLessThan){
					$query = $query . "average_points_earned < " . $averagePointsEarnedByClassLessThan . " ";
					$aFieldHasBeenUsed = true;
				}
				if($activatedOnOrAfter && $aFieldHasBeenUsed){
					$query = $query . $condition12 . " " . "time_of_activation >= '" . date("Y-m-d H:i:s",strtotime($activatedOnOrAfter)) . "' ";
				}else if($activatedOnOrAfter){
					$query = $query . "time_of_activation >= '" . date("Y-m-d H:i:s",strtotime($activatedOnOrAfter)) . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($activatedBefore && $aFieldHasBeenUsed){
					$query = $query . $condition13 . " " . "time_of_activation < '" . date("Y-m-d H:i:s",strtotime($activatedBefore)) . "' ";
				}else if($activatedBefore){
					$query = $query . "time_of_activation < '" . date("Y-m-d H:i:s",strtotime($activatedBefore)) . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($deactivatedOnOrAfter && $aFieldHasBeenUsed){
					$query = $query . $condition15 . " " . "time_of_deactivation >= '" . date("Y-m-d H:i:s",strtotime($deactivatedOnOrAfter)) . "' ";
				}else if($deactivatedOnOrAfter){
					$query = $query . "time_of_deactivation >= '" . date("Y-m-d H:i:s",strtotime($deactivatedOnOrAfter)) . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($deactivatedBefore && $aFieldHasBeenUsed){
					$query = $query . $condition16 . " " . "time_of_deactivation < '" . date("Y-m-d H:i:s",strtotime($deactivatedBefore)) . "' ";
				}else if($deactivatedBefore){
					$query = $query . "time_of_deactivation < '" . date("Y-m-d H:i:s",strtotime($deactivatedBefore)) . "' ";
					$aFieldHasBeenUsed = true;
				}
				if($aFieldHasBeenUsed){
					$query = $query . ")";
				}else{
					$query = substr($query, 0, strlen($query) - 6);
				}
				//do the search
				//echo $query;//todo: remove
				$questions = retrieve_by_query($query);
				//display the results
				echo "<table class='blueTable'>
				  <tr>
					<th>ID</th>
					<th>Question Statement</th> 
					<th>Correct Answer</th>
					<th>Potential Points</th>
					<th>Description</th>
					<th>Keywords</th>
					<th>Section</th>
					<th>Average Points Earned</th>
					<th>Time of Activation</th>
					<th>Time of Deactivation</th>
				  </tr>";
				foreach($questions as $question){
					echo "<tr>
						<td>" . $question['id'] . "</td>
						<td>" . $question['question_statement'] . "</td> 
						<td>" . $question['correct_answer'] . "</td>
						<td>" . $question['points'] . "</td>
						<td>" . $question['description'] . "</td>
						<td>" . $question['keywords'] . "</td> 
						<td>" . $question['section_number'] . "</td>
						<td>" . $question['average_points_earned'] . "</td>
						<td>" . $question['time_of_activation'] . "</td>
						<td>" . $question['time_of_deactivation'] . "</td>
					  </tr>";
				}
				echo "</table>";
			}else{
				echo "An error occurred while processing your request.";
			}
		}
	?>
	<p>When specifying more than one field, you must specify the operator before every additional field.</p>
	<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        Database ID is exactly: <input type="text" name="idIsExactly"><br>
		<select name="condition1">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
		Correct answer is exactly: <input type="text" name="correctAnswerIsExactly"><br>
		<select name="condition2">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
		Correct answer contains: <input type="text" name="correctAnswerContains"><br>
		<select name="condition3">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Number of points greater than: <input type="number" name="numberOfPointsGreaterThan"><br>
		<select name="condition4">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Number of points equal to: <input type="number" name="numberOfPointsEqualTo"><br>
		<select name="condition5">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Number of points less than: <input type="number" name="numberOfPointsLessThan"><br>
		<select name="condition6">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Description contains: <input type="text" name="descriptionContains"><br>
		<select name="condition7">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Contains in keywords: <input type="text" name="keywords"><br>
		<select name="condition8">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Section number equals: <input type="text" name="sectionNumber"><br>
		<select name="condition9">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Average points earned by class greater than: <input type="text" name="averagePointsEarnedByClassGreaterThan"><br>
		<select name="condition10">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Average points earned by class less than: <input type="text" name="averagePointsEarnedByClassLessThan"><br>
		<select name="condition12">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Activated at or after: <input type="datetime-local" name="activatedOnOrAfter"><br>
		<select name="condition13">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Activated before: <input type="datetime-local" name="activatedBefore"><br>
		<select name="condition15">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Deactivated at or after: <input type="datetime-local" name="deactivatedOnOrAfter"><br>
		<select name="condition16">
			<option value="OR">or</option>
			<option value="AND">and</option>
		</select>
        Deactivated before: <input type="datetime-local" name="deactivatedBefore"><br>
        <input type="submit">
    </form>
	<div class="footer">
		<p>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img style="border:0;width:88px;height:31px"
					src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
					alt="Valid CSS!" />
			</a>
			<img src="//www.w3.org/Icons/WWW/w3c_home_nb" alt="W3C" width="72" height="47" />
		</p>
	</div>
</body>
</html>