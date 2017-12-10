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
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<body>
    <h1>Active Question</h1>
	<?php
		require_once('../Database_files/initialize.php');
		$question = retrieve_all_activated_questions()[0];
		echo "<h2>" . $question['description'] . "</h2>";
		echo "Section: " . $question['section_number'] . "<br><br>";
		echo $question['question_statement'] . "<br>";
		echo $question['grader_code'];
	?>
    <a href="studenthome.php">Home</a><br>
    <a href="login.html">Logout</a>
</body>
</html>