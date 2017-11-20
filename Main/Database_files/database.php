<?php

  require_once('db_credentials.php');

  /* Connect to the database with the credentials given in the file above
     Return a handle to the PDO instance or output an error message and exit
   */



  function dbConnect() {
    try
    {
        $dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER,
                      DB_USER,
                      DB_PWD,
                      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      return $dbh;
    }
    catch (PDOException $e)
    {
        alert("Could not connect to the database.");
    } 
  }

  /* disconnect from the database, if needed
   */
  function dbDisconnect() {

   global $db;
   if (isset($db))
   {
     $db = null;
   }

  }

 ?>
