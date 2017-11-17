<?php

require_once('queries.php');
require_once('initialize.php');

$username =null;
$oldPassword = null;
$newPassword1 = null;
$newPassword2 = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $oldPassword = $_POST['oldpassword'];
    $newPassword1 = $_POST['newpassword'];
    $newPassword2 = $_POST['newpassword2'];

    change_password($username);
}



function change_password($user)
{
    global $db;

    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $newPassword2 = $_POST['newpassword2'];

    $oldPassHash = retrieve_student_password($user);
    $oldPassHash = $oldPassHash['password'];


    if (!check_student_username($user))
    {
        echo '<br/>no such username exists in the database.';
        //readfile("changepassword.html");

    }
    if (!verify_old_password($oldPassword, $oldPassHash))
    {
    
        echo '<br/>Old Password does not match your current password. ';
        //readfile("changepassword.html");

    }
    else if ($newPassword != $newPassword2)
    {
        echo '<br/>Password do not match.';
        //readfile("changepassword.html");
        return;
    }
    else
    {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $newHash = crypt($newPassword, '$2y$12$' . $salt);

        try
        {
            $query = "UPDATE `students`
                      SET `password` = '$newHash'
                      WHERE `username` = '$user'"; 
            $stmt = $db->prepare($query);
            $stmt->execute([]);

            echo '<br/>Password Changed!';

            return true;
        }
        catch (PDOException $e)
        {
            echo '<br/>' . $e;
            dbDisconnect();
            exit("<br/>Failed to change password");
        }

        echo 'reached else';
    }
}


function verify_old_password($password, $hash)
{
    echo '<br/>verifying password....';

    if(password_verify($password, $hash))
    {
        echo '<br/>password is valid!';
        return true;
    }
    else
    {
        echo '<br/>Invalid password!';
        return false;
    }
}


?>