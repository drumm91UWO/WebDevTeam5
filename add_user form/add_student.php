<?php

require_once('initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    add_student($userId, $username, $password, $lastName, $firstName,
             $email);

    dbDisconnect();
}


?>


<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8"/>
</head>
<body>
    <div id="content">
        <h1>Add new user</h1>

        <form action="add_student.php" method="post">
            User ID: <input type="text" name="userId" size="8" autofocus/><br/>

            First Name: <input type="text" name="firstName" size="16"/><br/>

            Last Name: <input type="text" name="lastName" size="16"/><br/>

            Username: <input type="text" name="username" size="16"/><br/>

            Password: <input type="text" name="password" size="16"/><br/>

            Email Address: <input type="text" name="email"/><br/>

            <input type="submit" name="submit" value="Add User"/>
        </fom>
    </div>
</body>
</html>
