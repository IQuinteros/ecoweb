<?php
require_once('../base_request.php');
require_once('../../query/question.php');

$question = new Question();

$result=$question->select_question($data);

if(is_null($result)){
    send_response(false, null, "Preguntas no encontradas"); 
}
else{
    // Return result
    send_response(true, $result);            
}