<?php

function add_user($id, $username, $password, $last, $first, $email)
{
    global $db;

    try 
    {
      echo $id . ' ' . $username . ' ' . $password . ' ' . $last . ' ' . $first . ' ' . $email;
        $numPassChanges = 0;

        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $hash = crypt($password, '$2y$12$' . $salt);

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


function retrieve_user($id)
{
    global $db;

    try 
    {
        $query = "SELECT * FROM users WHERE user_id = $id";

        $stmt = $db->prepare($query);
        $stmt->execute([]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e)
    {
        alert("Failed to retrieve user");
    }
}

?>