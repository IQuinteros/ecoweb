<?php
require_once('../base_request.php');
require_once('../../query/message.php');

$message = new Message();

$result=$message->insert_message($data);


send_response(isset($result), $result); 