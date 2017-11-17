<?php

require_once('queries.php');
require_once('initialize.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    $oldPassword = $_POST['oldpassword'];
    $newPassword1 = $_POST['newpassword'];
    $newPassword2 = $_POST['newpassword2'];

    change_password($username);
}



function change_password($username)
{
    global $db;

    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $newPassword2 = $_POST['newpassword2'];

    $oldPassHash = retrieve_student_password($username);
    $oldPassHash = $oldPassHash['password'];


    if (!student_username_exists($username))
    {
        readfile("changepassword.html"); // reload page
        echo '<br/>No such username exists in the database.';

    }
    else if  (!passwords_match($oldPassword, $oldPassHash))
    {        
        readfile("changepassword.html"); // reload page
        echo '<br/>Old Password does not match your current password.';
    }
    else if ($newPassword != $newPassword2)
    {
        readfile("changepassword.html"); // reload page
        echo '<br/>New passwords do not match.';
    }
    else
    {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $newHash = crypt($newPassword, '$2y$12$' . $salt);

        try
        {
            $query = "UPDATE `students`
                      SET `password` = '$newHash'
                      WHERE `username` = '$username'"; 
            $stmt = $db->prepare($query);
            $stmt->execute([]);

            update_student_num_password_changes($username);

            readFile("changepassword.html");
            echo '<br/>Password Changed!';

            return true;
        }
        catch (PDOException $e)
        {
            echo '<br/>' . $e;
            dbDisconnect();
            exit("<br/>Failed to change password");
        }

    }
}


function passwords_match($password, $hash)
{

    if(password_verify($password, $hash))
    {
        return true;
    }
    else
    {
        return false;
    }
}


?>