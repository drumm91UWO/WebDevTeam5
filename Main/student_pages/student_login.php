<?php
// Start session
session_start();

require_once('../database_files/initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = get_student_id($username);
    $userid = $user['id']; 

    if(verify($username, $password))
    {
        // Set session variables
        $_SESSION['username'] = $username; 
        $_SESSION['id'] = $userid;
        $_SESSION['acct_type'] = "student";

        update_last_student_login($userid);

        header('Location: studenthome.php');
    }
    else
    {
        header('Location: login.html');
        echo "<p>Username and password did not match any records in our database</p>";
    }
}

function verify($user, $pass)
{
    $isValid = false;

    if (verify_username($user))
    {
        if (verify_password($user, $pass))
        {
            $isValid = true;
        }
        else
        {
            $isValid = false;
        }
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

    if (student_username_exists($user))
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
    $pass = retrieve_student_password($user);
    $pass = $pass['password'];

    if (password_verify($enteredPass, $pass))
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