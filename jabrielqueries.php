<?php

 
    function update_status($questionid) {
  global $db;

  try {
    $query = "UPDATE `questions` 
                  SET `status` = inactive
                  WHERE `question_id` = '$questionid'";
	
    $stmt = $db->prepare($query);
    $stmt->execute();
	
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when updating the status of the question");
  }

  }
  

?>
