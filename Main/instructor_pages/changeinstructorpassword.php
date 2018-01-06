<?php
// Start session
session_start();
date_default_timezone_set('UTC');
require_once('../Database_files/initialize.php');
?>
<!DOCTYPE html>
<html lang=en>
<head>
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <title>Instructor Login Page</title>
    <meta charset="utf-8" />
    <meta name="author" content="Michael Drum" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<body>
    <h1>Change instructor password</h1>
	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = get_instructor_id($username);
    $userid = $user['id'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	if (verify_username($username))
	{
		if(verify($username, $password) && $password1 == $password2 && $password != $password1)
		{
			// Set session variables
			$_SESSION['username'] = $username; 
			$_SESSION['id'] = $userid;
			$_SESSION['acct_type'] = "instructor";
			update_last_instructor_login($userid);
			set_instructor_password($userid, get_new_encrypted_password($username, $password1));
			update_instructor_num_password_changes($username);
			echo "<script type='text/javascript'>alert('You successfully changed your password and logged in!')</script>";
            echo "<script>window.location.assign('instructorhome.php');</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Your login/password is incorrect or your new passwords did not match. Please try again. Also, make sure that your new password is different.')</script>";
		}
	}
	else
	{
        echo "<script type='text/javascript'>alert('Your login or password is incorrect. Please try again.')</script>";
	}
}
	?>

    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        Username: <input type="text" name="username" autofocus required><br>
        Password: <input type="password" name="password" required><br>
		New Password: <input type="password" name="password1" required><br>
		Confirm New Password: <input type="password" name="password2" required><br>
        <input type="submit">
    </form>
	<a href="instructorlogin.html">Just login</a>
</body>
<footer>
    <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px"
                src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                alt="Valid CSS!" />
            </a>
            <img src="//www.w3.org/Icons/WWW/w3c_home_nb" alt="W3C" width="72" height="47" />
        </p>
</footer>
</html>
<?php

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

function get_new_encrypted_password($user, $newpass){
	$salt = retrieve_instructor_salt($user);
	$salt = $salt['salt'];
	return crypt($newpass, '$2y$10$' . $salt);
}

?>