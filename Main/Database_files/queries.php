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

  /*  return a PDOstatement's result set containing the question with the
      given ID (this will be an empty result set, with no error, if there is no
      question with the given ID in the database)
      output an error message, disconnect, and exit in case something goes
      wrong
   */
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


  function retrieve_student_password($username)
  {
      global $db;

      try
      {
        $query = "SELECT password FROM students WHERE username = '$username'";

        $stmt = $db->prepare($query);
        $stmt->execute([]);
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
        $stmt->execute([]);
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
          $stmt->execute([]);
      }
      catch (PDOException $e)
      {
          // something went wrong when updating the number of password changes
      }
  }


  function update_instructor_num_password_changes($username)
  {
    global $db;

    try
    {
      $query = "UPDATE `instructors`
                SET `num_password_changes` = number_password_changes + 1
                WHERE `username` = '$username'";
      $stmt = $db->prepare($query);
      $stmt->execute([]);
    }
    catch (PDOException $e)
    {
        // something went wrong when updating the number of password changes
    }
  }

  
  function student_username_exists($username)
  {
    global $db;

    try 
    {
        $usernameExists = false;
        $query = "SELECT `username` FROM `students` 
                  WHERE `username` = '$username'";
        $stmt = $db->prepare($query);
        $stmt->execute([]);
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
        // something went wrong when verifying the entered username
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
      $stmt->execute([]);
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
        // something went wrong when verifying the entered username
    }
  }

?>
