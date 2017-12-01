<?php

  /* insert a new question into the database
     return true or output an error message, disconnect, and exit
   */
  function insert_question($id, $status, $question_statement, $correct_answer, $points, $description, 
		$keywords, $section_number, $number_correct_answers, $average_points_earned, $time_of_activation, 
		$time_of_deactivation, $grader_code, $score_earned) {

  global $db;

    try {
      $query = "INSERT INTO questions VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $db->prepare($query);
      $stmt->execute([$id, $status, $question_statement, $correct_answer, $points, $description, 
		$keywords, $section_number, $number_correct_answers, $average_points_earned, $time_of_activation, 
		$time_of_deactivation, $grader_code, $score_earned]);
      return true;
    } catch (PDOException $e) {
        dbDisconnect();
        //exit("Aborting: There was a database error when trying to insert the question.");
		exit($e);
    }

  }

  function retrieve_question($keywords,$description,$section_number,$points,$score_earned) {
  global $db;

  try {
    $query = "SELECT * FROM questions WHERE ( keywords IS NULL OR keywords = $keywords) 
												AND ( description IS NULL OR description = $description)
												AND  (section_number IS NULL OR section_number = $section_number) 
												AND (points IS NULL OR points = $points) 
												AND ( score_earned IS NULL OR score_earned = $score_earned) ";
	
    $stmt = $db->prepare($query);
    $stmt->execute();
	
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	
  } catch (PDOException $e) {
      dbDisconnect();
      exit("Aborting: There was a database error when trying to retrieve the question.");
  }

  }

  function retrieve_all_inactive_questions() {
	  global $db;
	  try {
		$query = "SELECT * FROM questions WHERE ( status = 'inactive') ";
	
		$stmt = $db->prepare($query);
		$stmt->execute();
	
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	  } catch (PDOException $e) {
		  dbDisconnect();
		  exit("Aborting: There was a database error when trying to retrieve the questions.");
	  }
  }

  function retrieve_all_activated_questions() {
	  global $db;
	  try {
		$query = "SELECT * FROM questions WHERE ( status = 'activated') ";
	
		$stmt = $db->prepare($query);
		$stmt->execute();
	
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	  } catch (PDOException $e) {
		  dbDisconnect();
		  exit("Aborting: There was a database error when trying to retrieve the questions.");
	  }
  }


  function retrieve_student_password($username)
  {
      global $db;

      try
      {
        $query = "SELECT password FROM students WHERE username = '$username'";

        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // returns the student's hashed password
      }
      catch (PDOException $e)
      {
          dbDisconnect();
          exit("There was a database error when trying to retrieve your password.");
      }
  }


  function retrieve_instructor_password($username)
  {
    global $db;

    try
    {
        $query = "SELECT password FROM instructors WHERE username = '$username'";

        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // returns the instructor's hashed password
    }
    catch (PDOException $e)
    {
      dbDisconnect();
      exit("There was a database error when trying to retrieve your password.");
    }
  }


  function update_student_num_password_changes($username)
  {
      global $db;

      try
      {
          $query = "UPDATE `students` 
                    SET `number_password_changes` = number_password_changes + 1
                    WHERE `username` = '$username'";
          $stmt = $db->prepare($query);
          $stmt->execute();
          return true;
      }
      catch (PDOException $e)
      {
          echo 'something went wrong when updating the number of password changes';
      }
  }


  function update_instructor_num_password_changes($username)
  {
    global $db;

    try
    {
      $query = "UPDATE instructors
                SET number_password_changes = number_password_changes + 1
                WHERE username = '$username'";
      $stmt = $db->prepare($query);
      $stmt->execute();
      return true;
    }
    catch (PDOException $e)
    {
      dbDisconnect();
      echo 'something went wrong when updating the number of password changes<br/>';
    }
  }

  
  function student_username_exists($username)
  {
    global $db;

    try 
    {
        $usernameExists = false;
        $query = "SELECT username FROM students
                  WHERE username = '$username'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($username === false)
        {
          $usernameExists = false;
        }
        else
        {
          $usernameExists = true;
        }

        return $usernameExists;
    }
    catch (PDOException $e)
    {
      dbDisconnect();
        echo 'something went wrong when verifying the entered username';
    }
  }


  function instructor_username_exists($username)
  {
    global $db;

    try
    {
      $usernameExists = false;
      $query = "SELECT `username` FROM `instructors` 
                WHERE `username` = '$username'";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user === false)
      {
        $usernameExists = false;
      }
      else
      {
        $usernameExists = true;
      }

      return $usernameExists;
    }
    catch (PDOException $e)
    {
      dbDiconnect();
        echo 'something went wrong when verifying the entered username';
    }
  }

  function set_status_activated($questionid) {
    global $db;
    try {
       $query = "UPDATE questions SET status = 'activated' WHERE id = $questionid";
       $stmt = $db->prepare($query);
       $stmt->execute();
       return  true;
    } catch (PDOException $e) {
        dbDisconnect();
        exit("Aborting: There was a database error when activating the question");
    }
  }

  function deactivate_all_activated_questions() 
  {
    global $db;
    try 
    {
       $query = "UPDATE questions SET status = 'inactive' WHERE status = 'activated'";
       $stmt = $db->prepare($query);
       $stmt->execute();
       return  true;
    } catch (PDOException $e) 
    {
        dbDisconnect();
        exit("Aborting: There was a database error when activating the question");
    }
  }

  function set_status_draft($questionid)
  {
      global $db;

       try 
       {
          $query = "UPDATE questions
                    SET `status` = draft
                    WHERE `question_id` = '$questionid'";

          $stmt = $db->prepare($query);
          $stmt->execute();

          return true;
        }
        catch (PDOException $e)
        {
          dbDisconnect();
          exit("Aborting: There was a database error when setting question to status 'draft'");
        }
      }


      function insert_student_score($studentid, $questionid, $score)
      {
          global $db;

          try
          {
            $query = "INSERT INTO scores VALUES (?,?,?)"; 
            $stmt = $db->prepare($query);
            $stmt-> execute([$studentid, $questionid, $score]);

            return true;
          }
          catch (PDOException $e)
          {
            dbDisconnect();
            exit("Aborting: An error occur when inserting your score into the database.");
          }
      }


      function update_last_student_login($userid)
      {
        global $db;

        try
        {
          $date = date("Y-m-d H:i:s");

          $query = "UPDATE students
                    SET `last_login` = '$date'
                    WHERE `id` = $userid";
          $stmt = $db->prepare($query);
          $stmt->execute();

          return true;
        }
        catch (PDOException $e)
        {
            dbDisconnect();
            exit("Aborting: An error occurred logging the login time.");
        }
      }


      function update_last_student_logout($id)
      {
        global $db;

        try
        {
          $date = date("Y-m-d H:i:s");

          $query = "UPDATE students
                    SET `last_logout` = '$date'
                    WHERE `id` = $id";
          $stmt = $db->prepare($query);
          $stmt->execute();

          return true;
        }
        catch (PDOException $e)
        {
            dbDisconnect();
            exit("Aborting: An error occurred logging the logout time.");
        }
      }

      function update_last_instructor_login($id)
      {
        global $db;

        try
        {
          $date = date("Y-m-d H:i:s");

          $query = "UPDATE instructors
                   SET `last_login` = '$date'
                   WHERE `id` = $id";
          $stmt = $db->prepare($query);
          $stmt->execute();

          return true;
        }
        catch (PDOException $e)
        {
          dbDisconnect();
          exit("Aborting: An error occurred logging the login time.");
        }
      }


      function update_last_instructor_logout($id)
      {
        global $db;

        try
        {
          $date = date("Y-m-d H:i:s");

          $query = "UPDATE instructors
                   SET `last_logout` = '$date'
                   WHERE `id` = $id";
          $stmt = $db->prepare($query);
          $stmt->execute();

          return true;
        }
        catch (PDOException $e)
        {
          dbDisconnect();
          exit("Aborting: An error occurred logging the logout time.");
        }
      }


      function get_student_id($username)
      {
        global $db;

        try 
        {
          $query = "SELECT id FROM students
                  WHERE username = '$username'";
                  $stmt = $db->prepare($query);
                  $stmt->execute();
          return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
          dbDisconnect();
          exit("Aborting: could not retrieve student id.");
        }
      }


      function get_instructor_id($username)
      {
        global $db;

        try 
        {
          $query = "SELECT `id` FROM instructors
                  WHERE `username` = '$username'";
          $stmt = $db->prepare($query);
          $stmt->execute([]);
          return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
          dbDisconnect();
          exit("Aborting: could not retrieve student id.");
        }
      }

?>
