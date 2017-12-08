<?php
//start session
session_start();

require_once('../Database_files/initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (verify_username($username))
    {
        $user = get_instructor_id($username);
        $userid = $user['id'];
    
        if(verify($username, $password))
        {
            // Set session variables
            $_SESSION['username'] = $username; 
            $_SESSION['id'] = $userid;
            $_SESSION['acct_type'] = "instructor";

            update_last_instructor_login($userid);

            header('Location: instructorhome.php');
        }
        else
        {
            header('Location: instructorlogin.html');
        }
    }
    else
    {
        header('Location: instructorlogin.html');
    }
}

function verify($user, $pass)
{
    $isValid = false;


    if (verify_password($user, $pass))
     {
         $isValid = true;
     }
    else
     {
         $isValid = false;
     }

    return $isValid;
}

function verify_username($user)
{
    $usernameExists = false;

    if (instructor_username_exists($user))
    {
        $usernameExists = true;
    }
    else
    {
        $usernameExists = false;
    }

    return $usernameExists;
}

function verify_password($user, $enteredPass)
{
    $isMatch = false;
    $pass = retrieve_instructor_password($user);
    $pass = $pass['password'];
    $salt = retrieve_instructor_salt($user);
	$salt = $salt['salt'];

    // Hash entered password
    $enteredPassHash = crypt($enteredPass, '$2y$10$' . $salt);

    if ($pass === $enteredPassHash)
    {
        $isMatch = true;
    }
    else
    {
        $isMatch = false;
    }

    return $isMatch;
}

?>