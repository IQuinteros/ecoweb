<?php
require_once('../base_request.php');
require_once('../../query/answer.php');

$answer = new Answer();

$result=$answer->delete_answer($data->id);


send_response(isset($result), $result); 