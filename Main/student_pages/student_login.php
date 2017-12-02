<?php
// Start session
session_start();

require_once('../Database_files/initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = get_student_id($username);
    $userid = $user['id']; 

	if (verify_username($username))
	{
		if(verify($username, $password))
		{
			// Set session variables
			$_SESSION['username'] = $username; 
			$_SESSION['id'] = $userid;
			$_SESSION['acct_type'] = "student";

			update_last_student_login($userid);

			header('Location: studenthome.php');
			exit();
		}
		else
		{
			header('Location: login.html');
			exit();
		}
	}
	else
	{
	
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
	$salt = retrieve_student_salt($user);
	$salt = $salt['salt'];

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