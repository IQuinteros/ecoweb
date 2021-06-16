<?php
require_once('../base_request.php');
require_once('../../query/chat.php');

$chat = new Chat();

$result=$chat->insert_chat($data);


send_response(isset($result), $result); 