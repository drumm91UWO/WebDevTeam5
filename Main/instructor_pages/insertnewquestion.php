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
		<link href="styles.css" rel="stylesheet" type="text/css">
		<title></title>
		<meta charset="utf-8" />
		<meta name="author" content="Michael Drum" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
	</head>
	<body>
		<h1>Insert New Question</h1>
		<?php
			require_once('Database_files/initialize.php');
			//gather input
			$id = $_POST["id"];
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
				if($id){
					insert_question($id, $status, $questionStatement, $correctAnswerIsExactly, $numberOfPoints, 
					$description, $keywords, $sectionNumber, null, null, null, null, $phpGraderCode, null);
				}else{
					insert_question(null, $status, $questionStatement, $correctAnswerIsExactly, $numberOfPoints, 
					$description, $keywords, $sectionNumber, null, null, null, null, $phpGraderCode, null);
				}
			}else{
				?><p>A necessary field was not filled out. Please <a href="insertnewquestion.html">try again</a>.</p><?php
			}

			header("Location: insertnewquestion.html");
		?>
	</body>
</html>