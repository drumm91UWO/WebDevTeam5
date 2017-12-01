<?php error_reporting ( E_ALL | E_STRICT ); ?>
<!DOCTYPE html>
<html lang=en>
<head>
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <title></title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <script type="text/javascript" src="activatequestion.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <h1>Activate Question</h1>
    <h3>With Insights</h3>
    <p>
        <select id="selector">
            <?php
		        require_once('../Database_files/initialize.php');
		        $questions = retrieve_all_not_activated_questions();
                $numberOfQuestions = count($questions);
                for($x = 0; $x < $numberOfQuestions; $x++){
                    ?><option value=<?php echo $questions[$x]['id']; ?>><?php echo $questions[$x]['description']; ?></option><?php
                }
            ?>
        </select>
    </p>
    <p>
        <button id="button" onclick="activateQuestion(document.getElementById('selector').value)">Activate Question</button> This will deactivate all questions before activating the selected question.<br>
        <button id="button2" onclick="deactivateQuestion()" disabled="true">Deactivate Question</button>
    </p>
    <div id="timer">
        The timer will be displayed here.
    </div>
    <div id="display">
        Data will be displayed here.
        <!--Display bar graph here-->
    </div>
    <a href="instructorhome.html">Home</a><br>
    <a href="login.html">Logout</a>
</body>
</html>