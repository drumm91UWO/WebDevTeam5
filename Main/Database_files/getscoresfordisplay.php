<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $id = $_POST['questionId'];
    if($id){
      echo json_encode(get_scores_for_display());
    }
}
?>
