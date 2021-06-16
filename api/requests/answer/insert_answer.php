<?php
require_once('../base_request.php');
require_once('../../query/answer.php');

$answer = new Answer();

$result=$question->insert_answer($data);


send_response(isset($result), $result); 