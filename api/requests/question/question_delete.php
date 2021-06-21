<?php
require_once('../base_request.php');
require_once('../../query/question.php');

$question = new Question();

$result=$question->delete_question($data->id);


send_response(isset($result), $result); 