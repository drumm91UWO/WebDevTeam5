<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $id = $_POST['questionId'];
	if($id){
		if(attempt_to_activate_question($id)){
			echo "Question " . $id . " was activated.";
		}else{
			echo "A question was not activated.";
		}
	}else{
		//deactivate all active questions
		deactivate_all_activated_questions();
		echo "All questions were deactivated";
	}
}
function attempt_to_activate_question($id){
	//deactivate all active questions
	deactivate_all_activated_questions();
	//activate question
	return set_status_activated($id);
}
?>