<?php
require_once('../base_request.php');
require_once('../../query/question.php');

$question = new Question();

$result=$question->insert_question($data);


send_response(isset($result), $result); 