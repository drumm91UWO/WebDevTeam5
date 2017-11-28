<?php

require_once('initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = get_student_id($username);
    $userid = $user[0]; 

    if(verify($username, $password))
    {
        // Start session
        session_start();
        // Set session variables
        $_SESSION['username'] = $username; 
        $_SESSION['userid'] = $userid;

        header('Location: ../studenthome.html');
    }
    else
    {
        header('Location: ../login.html');
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