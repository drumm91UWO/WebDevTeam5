<?php
require_once('initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    echo json_encode(retrieve_all_activated_questions());
}
?>