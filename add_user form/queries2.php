<?php

function add_student($id, $username, $password, $last, $first, $email)
{
    global $db;

    try 
    {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $hash = crypt($password, '$2y$12$' . $salt);

        $numPassChanges = 0;
        //var_dump($hash == crypt($password, $hash)); // To verify password

        $query = "INSERT INTO `students` VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$id, $username, $first, $last, $email, $hash, 
                        $numPassChanges, null, null]);
        echo "User added successfully!";
        return true;
    }
    catch (PDOException $e)
    {
        echo '<br/>' . $e;
        echo "<br/>Failed to add user";
    }

}


function add_instructor($id, $username, $password, $last, $first, $email)
{
    global $db;

    try 
    {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $hash = crypt($password, '$2y$12$' . $salt);

        //var_dump($hash == crypt($password, $hash)); // To verify password

        $query = "INSERT INTO `instructors` VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$id, $username, $first, $last, $email, $hash, 
                        $numPassChanges, null, null]);
        echo "User added successfully!";
        return true;
    }
    catch (PDOException $e)
    {
        echo '<br/>' . $e;
        echo "<br/>Failed to add user";
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