<?php
require_once('../base_request.php');
require_once('../../query/message.php');

$message = new Message();

$result=$message->delete_message($data->id);


send_response(isset($result), $result);