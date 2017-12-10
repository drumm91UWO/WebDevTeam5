<?php
session_start();
if (! isset($_SESSION['acct_type']) || $_SESSION['acct_type'] != "student")
{
    header("Location: login.html");
    exit();
	error_reporting ( E_ALL | E_STRICT );
}
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <title>Active Question</title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
   integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
   integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
   <link href="../styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>Active Question</h1>


    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="studenthome.php"><img src="../../images/UWOWebClicker.png" alt="UWO WebClicker"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="studenthome.php">Home</a>
            <a class="nav-item nav-link" href="#">Search Previous Questions <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="student_logout.php">Logout</a>
         </div>
    </div>
    </nav>

	<?php
		require_once('../Database_files/initialize.php');
		$question = retrieve_all_activated_questions()[0];
		echo "<h2>" . $question['description'] . "</h2>";
		echo "Section: " . $question['section_number'] . "<br><br>";
		echo $question['question_statement'] . "<br>";
		echo $question['grader_code'];
	?>
</body>
</html>